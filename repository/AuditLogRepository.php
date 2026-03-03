<?php
// Repository/AuditLogRepository.php

// Load the AuditLog business model, as the Repository must instantiate and return AuditLog objects.
require_once __DIR__ . '/../model/AuditLog.php';

// Load the DatabaseSingleton, as the Repository needs its generic query execution methods.
require_once __DIR__ . '/../database/DatabaseSingleton.php';

class AuditLogRepository {
    // Dependency Injection: The Repository requires the Database access object.
    private DatabaseSingleton $db;

    public function __construct(DatabaseSingleton $db) {
        $this->db = $db;
    }

    /**
     * Converts a raw database array row into a AuditLog Model object.
     * This is the bridge between the Data Access Layer (Repository) and the
     * Business Logic Layer (Model).
     */
    private function createModelFromRow(array $row): AuditLog {
        return new AuditLog(
            (int)$row['auditLogId'],
            Action::from($row["action"]),
            $row["entity"],
            $row["entry"]
        );
    }

    // ----------------------------------------------------------------------
    //                           FETCH METHODS
    // ----------------------------------------------------------------------

    /**
     * Finds a single AuditLog by its primary key ID.
     * @param int $id The primary key ID
     */
    public function findById(int $id): ?AuditLog {
        $sql = "SELECT * FROM `auditLogs` WHERE `auditLogId` = :id";

        $results = $this->db->query($sql, ['id' => $id]);

        if (empty($results)) {
            return null;
        }

        // Convert the raw data to a single AuditLog object
        return $this->createModelFromRow($results[0]);
    }

    /**
     * Finds all AuditLogs in the database.
     * @return AuditLog[] An array of AuditLog objects
     */
    public function findAll(): array {
        $sql = "SELECT * FROM `auditLogs` ORDER BY `auditLogId` ASC";
        $results = $this->db->query($sql);

        // Convert all raw results into an array of Movie objects
        return array_map($this->createModelFromRow(...), $results);
    }

    // ----------------------------------------------------------------------
    //                           PERSISTENCE METHOD
    // ----------------------------------------------------------------------

    /**
     * Saves a AuditLog Model to the database, handling either INSERT or UPDATE.
     * @return bool Success Did the INSERT/UPDATE succeed or fail?
     */
    public function save(AuditLog $AuditLog): bool {
        if ($AuditLog->id === null) {
            // INSERT (New AuditLog)
            $sql = "INSERT INTO auditLogs VAlUES (:id, :timestamp, :entity, :action, :entry)";
            $rowsAffected = $this->db->execute($sql, ["id" => $AuditLog->id, "timestamp" => $AuditLog->time, "entity" => $AuditLog->target, "action" => $AuditLog->action->value, "entry" => $AuditLog->effect]);
            return $rowsAffected > 0;
        }
        else {
            // UPDATE (Existing AuditLog)
            $sql = "UPDATE auditLogs SET username = :username, password = :password, role = :role, firstName = :firstName, lastName = :lastName, street = :street, town = :town, postcode = :postcode, phone = :phone, email = :email WHERE AuditLogId = :id";
            $rowsAffected = $this->db->execute($sql, ["id" => $AuditLog->id, "timestamp" => $AuditLog->time, "entity" => $AuditLog->target, "action" => $AuditLog->action->value, "entry" => $AuditLog->effect]);
            return $rowsAffected == 1;
        }
    }
}
