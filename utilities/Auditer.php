<?php
// utilities/Auditer.php

// Grab our dependencies
require_once __DIR__ . "/../model/AuditLog.php";
require_once __DIR__ . "/../repository/AuditLogRepository.php";

/**
 * Auditable interface MUST be implemented for a model to be auditable
 * @method repr(): string | Gives a human-readable, concise representation of the model
 * @method name(): string | Gives the name of the model in lowercase, given that the name of the model is always the singular form of the name of the table
 */
interface Auditable {
    public function repr(): string;
    public function name(): string;
}

/**
 * Utility class that implements the behaviours required of the Auditing system.
 * Is effectively a controller for the Audits
 */
class Auditer {
    private AuditLogRepository $repository;

    public function __construct(DatabaseSingleton $db) {
        $this->repository = new AuditLogRepository($db); // Uses dependency injection to construct our auditLog repository
    }

    /**
     * Makes the login entry for a specific auditable model.
     * @param Auditable $model
     * @return bool Successful database insertion
     */
    public function logIn(Auditable $model) {
        $info = $model->repr();
        return $this->repository->save(new AuditLog(null, Action::Login(), $info, "$info logged in"));
    }

    /**
     * Makes the logout entry for when the provided model has logged out. Call when logging the user out
     * @param Auditable $model
     * @return bool Successful database insertion
     */
    public function logOut(Auditable $model) {
        $info = $model->repr();
        return $this->repository->save(new AuditLog(null, Action::Logout(), $info, "$info logged out"));
    }

    /**
     * Makes the BasketConfirmed entry for when an order has been placed.
     * @param Member $customer
     * @param Booking[] $bookings
     * @return bool Successful database insertion
     */
    public function orderPlaced(Member $customer, array $bookings) {
        $customer = $customer->repr();
        $items = array_reduce($bookings, fn($carr, $item) => "$carr, " . $item->repr());
        return $this->repository->save(new AuditLog(null, Action::Order(), "Orders", "$customer placed a new order with items: $items"));
    }

    /**
     * Makes the create entry for the creation of the provided model. Call whenever an INSERT statement is run
     * @param Auditable $model
     * @return bool Successful database insertion
     */
    public function create(Auditable $model) {
        $info = $model->repr();
        $name = $model->name();
        return $this->repository->save(new AuditLog(null, Action::Insert(), $name."s table", "new $info created"));
    }

    /**
     * Makes the update entry for the creation of the provided model. Call whenever an UPDATE statement is run
     * @param Auditable $model
     * @return bool Successful database insertion
     */
    public function update(Auditable $model) {
        $info = $model->repr();
        return $this->repository->save(new AuditLog(null, Action::Update(), $info, "$info was updated"));
    }

    /**
     * Makes the deletion entry for the creation of the provided model. Call whenever a DELETE statement is run
     * @param Auditable $model
     * @return bool Successful database insertion
     */
    public function delete(Auditable $model) {
        $info = $model->repr();
        return $this->repository->save(new AuditLog(null, Action::Delete(), $info, "$info was deleted"));
    }

}