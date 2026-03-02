<?php
// model/User.php

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

class Member {
    public ?int $memberId;
    public string $username;
    public string $password; //Note that the password is always hashed! We never store this in plaintext
    public Role $role;
    public string $firstName;
    public string $lastName;
    public ?string $street;
    public ?string $town;
    public ?string $postcode;
    public ?string $phone;
    public ?string $email;

    public function __construct(
        ?int $id,
        string $username,
        string $password,
        string $firstName,
        string $lastName,
        Role $role,
        ?string $street,
        ?string $town,
        ?string $postcode,
        ?string $phone,
        ?string $email
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

}