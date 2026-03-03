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
        return $this->repository->save(new AuditLog(null, Action::Login, "Member (id = $id, username = $username)", null));
    }

    public function logOut(Member $member) {
        
    $id = $member->memberId;
        $username = $member->username;
        return $this->repository->save(new AuditLog(null, Action::Logout, "Member (id = $id, username = $username)", null));
    }

    public function createUser(Member $member) {
        return $this->repository->save(new AuditLog(null, Action::Insert, "members table", "new Member created: $member"));
    }

    public function updateUser(Member $member) {
        $id = $member->memberId;
        $username = $member->username;
        return $this->repository->save(new AuditLog(null, Action::Update, "Member (id = $id, username = $username)", "member data updated to: $member"));
    }

    public function deleteUser(Member $member) {
        $id = $member->memberId;
        $username = $member->username;
        return $this->repository->save(new AuditLog(null, Action::Delete, "Member (id = $id, username = $username)", "member deleted with data: $member"));
    }

}