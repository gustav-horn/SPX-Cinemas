<?php
// model/User.php

// Grab our required type-defs
require_once __DIR__ . "/../utilities/Encryption.php";
require_once __DIR__ . "/../utilities/Auditer.php";

class Role {
    public string $value;

    public function __construct($value) {
        $this->value = $value;
    }

    // Utility constructor from a specific string
    public static function from(string $role): Role {
        return match($role) {
            "User" => new Role("user"),
            "Administrator" => new Role("admin"),
        };
    }

    // Utility serialisation function
    public function tostring(): string {
        return $this->value;
    }
}

class Member implements Auditable {
    // Properties match the database columns for data storage
    // Note:
    //  ? at type indicates the property can be null

    public ?int $memberId;
    public string $username;
    public HashedData $password; //Note that the password is always hashed! We never store this in plaintext
    public Role $role;
    public EncryptedData $firstName;
    public EncryptedData $lastName;
    public OptionalEncryptedData $street;
    public OptionalEncryptedData $town;
    public OptionalEncryptedData $postcode;
    public OptionalEncryptedData $phone;
    public OptionalEncryptedData $email;

    public function __construct(
        ?int $id,
        string $username,
        HashedData $password,
        EncryptedData $firstName,
        EncryptedData $lastName,
        Role $role,
        OptionalEncryptedData $street,
        OptionalEncryptedData $town,
        OptionalEncryptedData $postcode,
        OptionalEncryptedData $phone,
        OptionalEncryptedData $email
    ) 
    {
        $this->memberId = $id;
        $this->username = $username;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->role = $role;
        $this->street = $street;
        $this->town = $town;
        $this->postcode = $postcode;
        $this->phone = $phone;
        $this->email = $email;
    }

    public function repr(): string {
        return "Member(id = $this->memberId, username = $this->username)";
    }

    public function name(): string {
        return "Member";
    }

}