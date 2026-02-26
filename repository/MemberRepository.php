<?php
// Repository/MemberRepository.php

// Load the Member business model, as the Repository must instantiate and return Member objects.
require_once __DIR__ . '/../model/Member.php';

// Load the DatabaseSingleton, as the Repository needs its generic query execution methods.
require_once __DIR__ . '/../database/DatabaseSingleton.php';

class MemberRepository {

    // Dependency Injection: The Repository requires the Database access object.
    private DatabaseSingleton $db;

    public function __construct(DatabaseSingleton $db) {
        $this->db = $db;
    }

    /**
     * Converts a raw database array row into a Member Model object.
     * This is the bridge between the Data Access Layer (Repository) and the
     * Business Logic Layer (Model).
     */
    private function createModelFromRow(array $row): Member {
        return new Member(
            (int)$row['memberId'],
            $row['username'],
            $row['password'],
            Role::from($row['role']),
            $row['street'],
            $row['town'],
            $row['postcode'],
            $row['phone'],
            $row['email']
        );
    }

    // ----------------------------------------------------------------------
    //                           FETCH METHODS
    // ----------------------------------------------------------------------

    /**
     * Finds a single Member by its primary key ID.
     */
    public function findById(int $id): ?Member {
        $sql = "SELECT * FROM `members` WHERE `memberId` = :id";

        $results = $this->db->query($sql, ['id' => $id]);

        if (empty($results)) {
            return null;
        }

        // Convert the raw data to a single Member object
        return $this->createModelFromRow($results[0]);
    }

    /**
     * Fihnds a single member by its username
     */
    public function findByUsername(string $username): ?Member {
        $sql = "SELECT * FROM `members` WHERE username = :username";

        $results = $this->db->query($sql, ['username' => $username]);

        if (empty($results)) {
            return null;
        }

        // Convert the raw data to a single Member object
        return $this->createModelFromRow($results[0]);
    }

    /**
     * Finds all members in the database.
     * @return Member[] An array of Member objects
     */
    public function findAll(): array {
        $sql = "SELECT * FROM `members` ORDER BY `memberId` ASC";
        $results = $this->db->query($sql);

        // Convert all raw results into an array of Movie objects
        return array_map($this->createModelFromRow(...), $results);
    }

    // ----------------------------------------------------------------------
    //                           PERSISTENCE METHOD
    // ----------------------------------------------------------------------

    /**
     * Saves a Member Model to the database, handling either INSERT or UPDATE.
     * @return bool Success Did the INSERT/UPDATE succeed or fail?
     */
    public function save(Member $member): bool {
        if ($member->memberId === null) {
            // INSERT (New Member)
            $sql = "INSERT INTO members VAlUES (:id, :username, :password, :role, :firstName, :lastName, :street, :town, :postcode, :phone, :email)";
            $rowsAffected = $this->db->execute($sql, ["id" => $member->memberId, "username" => $member->username, "password" => $member->password, "role" => $member->role, "firstName" => $member->firstName, "lastName" => $member->lastName, "street" => $member->street, "town" => $member->town, "postcode" => $member->postcode, "phone" => $member->phone, "email" => $member->email]);
            return $rowsAffected > 0;
        }
        else {
            // UPDATE (Existing Member)
            $sql = "UPDATE members SET username = :username, password = :password, role = :role, firstName = :firstName, lastName = :lastName, street = :street, town = :town, postcode = :postcode, phone = :phone, email = :email WHERE locationId = :id";
            $rowsAffected = $this->db->execute($sql, ["username" => $member->username, "password" => $member->password, "role" => $member->role, "firstName" => $member->firstName, "lastName" => $member->lastName, "street" => $member->street, "town" => $member->town, "postcode" => $member->postcode, "phone" => $member->phone, "email" => $member->email]);
            return $rowsAffected == 1;
        }
    }
}