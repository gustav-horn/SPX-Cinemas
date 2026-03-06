<?php
// model/User.php

// Grab our required type-defs
require_once __DIR__ . "/../utilities/Encryption.php";
require_once __DIR__ . "/../utilities/Auditer.php";

enum Role {
    case user;
    case admin;

    public static function from(string $role): Role {
        return match($role) {
            "User" => Role::user,
            "Administrator" => Role::admin,
        };
    }

    public function tostring(): string {
        return match($this) {
            self::user => "user",
            self::admin => "admin",
        };
    }
}

class Member implements Auditable {
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