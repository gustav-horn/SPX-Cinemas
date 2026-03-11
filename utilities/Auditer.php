<?php
// utilities/Auditer.php

// Grab our dependencies
require_once __DIR__ . "/../model/AuditLog.php";
require_once __DIR__ . "/../repository/AuditLogRepository.php";

interface Auditable {
    public function repr(): string;
    public function name(): string;
}

class Auditer {

    private AuditLogRepository $repository;

    public function __construct(DatabaseSingleton $db) {
        $this->repository = new AuditLogRepository($db);
    }

    public function logIn(Auditable $model) {
        $info = $model->repr();
        return $this->repository->save(new AuditLog(null, Action::Login, $info, "$info logged in"));
    }

    public function logOut(Auditable $model) {
        $info = $model->repr();
        return $this->repository->save(new AuditLog(null, Action::Logout, $info, "$info logged out"));
    }

    public function create(Auditable $model) {
        $info = $model->repr();
        $name = $model->name();
        return $this->repository->save(new AuditLog(null, Action::Insert, $name."s table", "new $info created"));
    }

    public function update(Auditable $model) {
        $info = $model->repr();
        return $this->repository->save(new AuditLog(null, Action::Update, $info, "$info was updated"));
    }

    public function delete(Auditable $model) {
        $info = $model->repr();
        return $this->repository->save(new AuditLog(null, Action::Delete, $info, "$info was deleted"));
    }

}