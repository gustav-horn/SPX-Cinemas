<?php
// utilities/Auditer.php

// Grab our dependencies
require_once __DIR__ . "/../model/AuditLog.php";
require_once __DIR__ . "/../repository/AuditLogRepository.php";

class Auditer {

    private AuditLogRepository $repository;

    public function __construct(DatabaseSingleton $db) {
        $this->repository = new AuditLogRepository($db);
    }

    public function logIn(Member $member) {
        $id = $member->memberId;
        $username = $member->username;
        return $this->repository->save(new AuditLog(null, Action::Login, "Member (id = $id, username = $username)", "Member (username = $username) logged in"));
    }

    public function logOut(Member $member) {
        $id = $member->memberId;
        $username = $member->username;
        return $this->repository->save(new AuditLog(null, Action::Logout, "Member (id = $id, username = $username)", "Member (username = $username) logged out"));
    }

    public function createUser(Member $member) {
        $username = $member->username;
        return $this->repository->save(new AuditLog(null, Action::Insert, "members table", "new Member created. Username: $username"));
    }

    public function updateUser(Member $member) {
        $id = $member->memberId;
        $username = $member->username;
        return $this->repository->save(new AuditLog(null, Action::Update, "Member (id = $id, username = $username)", "Member (id = $id, username = $username) updated their personal data"));
    }

    public function deleteUser(Member $member) {
        $id = $member->memberId;
        $username = $member->username;
        return $this->repository->save(new AuditLog(null, Action::Delete, "Member (id = $id, username = $username)", "Member (id = $id, username = $username) deleted their account"));
    }

}