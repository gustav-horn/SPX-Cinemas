<?php
// utilities/SessionManager.php

require_once __DIR__ . "/../model/Member.php";

require_once __DIR__ . "/../database/DatabaseSingleton.php";
require_once __DIR__ . "/Auditer.php";

enum SessionStatus {
    case LoggedIn;
    case NotLoggedIn;
}


class SessionManager {
    private static $SESSION_LENGTH = 5*60; //Session length defined as 5 minutes (5 x 60s)
    private Auditer $auditer;

    public function __construct(string $currPage) {
        $this->auditer = new Auditer(DatabaseSingleton::getInstance());

        // Try to initiate the session. If we can't; abort and run around like a headless chicken.
        if (!session_start(["serialize_handler" => 'php_serialize'])) {
            error_log("Session unable to be started");
            exit("Session unable to be started");
        }
        // Check to see if we've met this client. If we haven't default to logged out.
        if (!isset($_SESSION["CurrentStatus"])) {
            $this->loggedOut($currPage); 
            return; //Returning early for readability
        }
        // If we've met them, check to see if their session has expired.
        switch ($_SESSION["CurrentStatus"]) {
            case SessionStatus::LoggedIn: {
                if ((time() - $_SESSION["CurrentInfo"]->lastTimeActed) > $this::$SESSION_LENGTH) {
                    $this->loggedOut($currPage);
                }
                else {
                    $_SESSION["CurrentInfo"]->lastTimeActed = time();
                }
            };
        }
    }

    public function updateCurrPage(string $currPage) {
        switch($_SESSION["CurrentStatus"]) {
            case SessionStatus::NotLoggedIn: $_SESSION["CurrentInfo"]->lastPageUsed = $currPage; break;
        };
    }

    public function loggedIn(Member $user) {
        $this->auditer->logIn($user);
        $_SESSION["CurrentStatus"] = SessionStatus::LoggedIn;
        $_SESSION["CurrentInfo"] = new LoggedInUser($user, time());
    }

    public function loggedOut(string $currPage) {
        // Check to see if we are currently logged in or not. If we are logged in, make the auditLog
        match ($_SESSION["CurrentStatus"]) {
            SessionStatus::LoggedIn => $this->auditer->logOut($_SESSION["CurrentInfo"]->user)
        };
        $_SESSION["CurrentStatus"] = SessionStatus::NotLoggedIn;
        $_SESSION["CurrentInfo"] = new NotLoggdIn($currPage);
    }

    public function checkLoggedIn(): bool {
        return match($_SESSION["CurrentStatus"]) {
            SessionStatus::LoggedIn => true,
            SessionStatus::NotLoggedIn => false,
        };
    }

    public function getLastPage(): ?string {
        return match($_SESSION["CurrentStatus"]) {
            SessionStatus::LoggedIn => null,
            SessionStatus::NotLoggedIn => $_SESSION["CurrentInfo"]->lastPageUsed,
        };
    }

    public function getActiveUser(): ?Member {
        return match($_SESSION["CurrentStatus"]) {
            SessionStatus::LoggedIn => $_SESSION["CurrentInfo"]->user,
            SessionStatus::NotLoggedIn => null,
        };
    }
}
class LoggedInUser {
    public Member $user;
    public int $lastTimeActed;

    public function __construct(Member $user, int $time) {
        $this->user = $user;
        $this->lastTimeActed = $time;
    }
}

class NotLoggdIn {
    public string $lastPageUsed;

    public function __construct(string $currPage) {
        $this->lastPageUsed = $currPage;
    }
}