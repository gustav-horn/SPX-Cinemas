<?php
// model/User.php

enum Role {
    case user;
    case admin;
}

class Member {
    public ?int $memberId;
    public string $username;
    public string $password; //Note that the password is always hashed! We never store this in plaintext
    public Role $role;
    public string $firstName;
    public string $lastName;
    public string $street;
    public string $town;
    public string $postcode;
    public string $phone;
    public string $email;

    public function __construct(
        ?int $id,
        string $username,
        string $password,
        Role $role,
        string $street,
        string $town,
        string $postcode,
        string $phone,
        string $email
    ) 
    {
        $this->$id = $id;
        $this->$username = $username;
        $this->$password = $password;
        $this->$role = $role;
        $this->$street = $street;
        $this->$town = $town;
        $this->$postcode = $postcode;
        $this->$phone = $phone;
        $this->$email = $email;
    }

}