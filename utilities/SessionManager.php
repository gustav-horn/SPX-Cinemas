<?php
// utilities/SessionManager.php

require_once __DIR__ . "/../model/Member.php";

require_once __DIR__ . "/../database/DatabaseSingleton.php";
require_once __DIR__ . "/Auditer.php";

enum SessionStatus {
    case LoggedIn;
    case NotLoggedIn;
}


/**
 * Utility class that manages the session.
 * Controls the following $_SESSION fields:
 * 
 * - CurrentStatus: LoggedIn or NotLoggedIn
 * - CurrentInfo: LoggedInUser or NotLoggedIn
 * 
 * NO ONE ELSE CAN TOUCH THEM unless you want *really* bad things to happen.
 */
class SessionManager {
    private static $SESSION_LENGTH = 5*60; //Session length defined as 5 minutes (5 x 60s)
    private Auditer $auditer;

    /**
     * Constructor handles most of the session handling.
     * This is because the constructor is alsways called in index.php and must interact with the $_SESSION superglobal.
     * Thus, it was considered beneficial to determine the current state during initialisation.
     * @param string $currPage
     * @return void
     */
    public function __construct(string $currPage) {
        // We instantiate the auditer to make the logs when logging in and logging out
        $this->auditer = new Auditer(DatabaseSingleton::getInstance());

        // Try to initiate the session. If we can't; abort and panic!
        if (!session_start(["serialize_handler" => 'php_serialize']) && !session_start(["serialize_handley" => 'php_serialize'])) { // For some reason trying it twice seems to help
            error_log("Session unable to be started");
            exit("Session unable to be started");
        }
        // Check to see if we've met this client. If we haven't default to logged out.
        if (!isset($_SESSION["CurrentStatus"])) {
            $_SESSION["CurrentStatus"] = SessionStatus::NotLoggedIn;
            $_SESSION["CurrentInfo"] = new NotLoggedIn($currPage);
            return; //Returning early for readability
        }
        // If we've met them, check to see if their session has expired.
        switch ($_SESSION["CurrentStatus"]) {
            case SessionStatus::LoggedIn: {
                if ((time() - $_SESSION["CurrentInfo"]->lastTimeActed) > $this::$SESSION_LENGTH) {
                    $this->loggedOut($currPage);
                    header("Location: index.php?page=login");
                }
                else {
                    $_SESSION["CurrentInfo"]->lastTimeActed = time();
                }
            };
        }
    }

    /**
     * Helper function that updates the current page of a NotLoggedIn user to the provided page.
     * @param string $currPage
     * @return void
     */
    public function updateCurrPage(string $currPage) {
        switch($_SESSION["CurrentStatus"]) {
            case SessionStatus::NotLoggedIn: $_SESSION["CurrentInfo"]->lastPageUsed = $currPage; break;
        };
    }

    /**
     * Helper function that manages the state changes that occur when the provided user is logged in.
     * @param Member $user
     * @return void
     */
    public function loggedIn(Member $user) {
        $this->auditer->logIn($user);
        $_SESSION["CurrentStatus"] = SessionStatus::LoggedIn;
        $_SESSION["CurrentInfo"] = new LoggedInUser($user, time());
    }

    /**
     * Helper function that manages the state changes that occur when a user is logged out.
     * Also sets the current page.
     * @param string $currPage
     * @return void
     */
    public function loggedOut(string $currPage) {
        // Check to see if we are currently logged in or not. If we are logged in, make the auditLog
        match ($_SESSION["CurrentStatus"]) {
            SessionStatus::LoggedIn => $this->auditer->logOut($_SESSION["CurrentInfo"]->user)
        };
        $_SESSION["CurrentStatus"] = SessionStatus::NotLoggedIn;
        $_SESSION["CurrentInfo"] = new NotLoggedIn($currPage);
    }

    /**
     * Utility function that returns true if a user is logged in
     * @return bool
     */
    public function checkLoggedIn(): bool {
        return match($_SESSION["CurrentStatus"]) {
            SessionStatus::LoggedIn => true,
            SessionStatus::NotLoggedIn => false,
        };
    }

    /**
     * Utility function that returns the last page accessed by the user (the currPage in internal data).
     * Use it for redirects after the user succesfully logs in.
     * Retruns null iff (if and only if) the user is already logged in.
     * @return ?string
     */
    public function getLastPage(): ?string {
        return match($_SESSION["CurrentStatus"]) {
            SessionStatus::LoggedIn => null,
            SessionStatus::NotLoggedIn => $_SESSION["CurrentInfo"]->lastPageUsed,
        };
    }

    /**
     * Utility function that returns the currently logged in user.
     * Return null iff (if and only if) no one is currently logged in.
     * @return ?Member
     */
    public function getActiveUser(): ?Member {
        return match($_SESSION["CurrentStatus"]) {
            SessionStatus::LoggedIn => $_SESSION["CurrentInfo"]->user,
            SessionStatus::NotLoggedIn => null,
        };
    }
}

/**
 * Dataclass that holds the currently logged in member and the last time they interacted with the webpage.
 * @var $user The currently logged in user
 * @var $lastTimeActed The last time the currently logged in user made a request to the webserver. Stored in seconds since the unix epoch.
 */
class LoggedInUser {
    public Member $user;
    public int $lastTimeActed;

    public function __construct(Member $user, int $time) {
        $this->user = $user;
        $this->lastTimeActed = $time;
    }
}

/**
 * Dataclass that holds the last page accessed by the logged out 'user' (whoever the current client is)
 * @var $lastPageUsed Records the last page accessed or attempted to access.
 */
class NotLoggedIn {
    public string $lastPageUsed;

    public function __construct(string $currPage) {
        $this->lastPageUsed = $currPage;
    }
}