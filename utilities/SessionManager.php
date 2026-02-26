<?php
// utilities/SessionManager.php

enum SessionStatus {
    case LoggedIn;
    case NotLoggdIn;
}


class SessionManager {
    private static $SESSION_LENGTH = 5*60; //Session length defined as 5 minutes (5 x 60s)

    public function __construct(string $currPage) {
        if (session_start()) {
            if (!isset($_SESSION["CurrentStatus"])) {
                $this->loggedOut($currPage);
            }
            else {
                switch($_SESSION["CurrentStatus"]) {
                    case SessionStatus::LoggedIn : 
                        if ((time() - $_SESSION["CurrentInfo"]->lastTimeActed) > $this->SESSION_LENGTH) {
                            $this->loggedOut($currPage);
                        }
                        else {
                            $_SESSION["CurrentInfo"]->lastTimeActed = time();
                        }
                        break;
                    case SessionStatus::NotLoggdIn : $_SESSION["CurrentInfo"]->lastPageUsed = $currPage; break;
                }
            }
        }
        else {
            exit("Session unable to be started");
        }
    }

    public function loggedIn(Member $user) {
        $_SESSION["CurrentStatus"] = SessionStatus::LoggedIn;
        $_SESSION["CurrentInfo"] = new LoggedInUser($user, time());
    }

    public function loggedOut(string $currPage) {
        $_SESSION["CurrentStatus"] = SessionStatus::NotLoggdIn;
        $_SESSION["CurrentInfo"] = new NotLoggdIn($currPage);
    }

    public function checkLoggedIn(): bool {
        return match($_SESSION["CurrentStatus"]) {
            SessionStatus::LoggedIn => true,
            SessionStatus::NotLoggdIn => false,
        };
    }

    public function getLastPage(): ?string {
        return match($_SESSION["CurrentStatus"]) {
            SessionStatus::LoggedIn => null,
            SessionStatus::NotLoggdIn => $_SESSION["CurrentInfo"]->lastPageUsed,
        };
    }

    public function updatePage(string $currPage) {
        switch($_SESSION["CurrentStatus"]) {
            case SessionStatus::NotLoggdIn : $_SESSION["CurrentInfo"]->lastPageUsed = $currPage; break;
            case SessionStatus::LoggedIn : break;
        }
    }
}
class LoggedInUser {
    public Member $user;
    public int $lastTimeActed;

    public function __construct(Member $user, int $time) {
        $this->$user = $user;
        $this->$lastTimeActed = $time;
    }
}

class NotLoggdIn {
    public string $lastPageUsed;

    public function __construct(string $currPage) {
        $this->lastPageUsed = $currPage;
    }
}