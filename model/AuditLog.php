<?php
// Model/AuditLog.php

require_once __DIR__ . "/../utilities/Auditer.php";

// enum Action: string {
//     case Login = "login";
//     case Logout = "logout";
//     case Order = "order";
//     case Insert = "insert";
//     case Delete = "delete";
//     case Update = "update";
// }

class Action {
    public string $value;

    private function __construct($value) {
        $this->value = $value;
    }

    public static function Login() {
        return new Action("login");
    }

    public static function Logout() {
        return new Action("logout");
    }

    public static function Order() {
        return new Action("order");
    }

    public static function Insert() {
        return new Action("insert");
    }

    public static function Delete() {
        return new Action("delete");
    }

    public static function Update() {
        return new Action("update");
    }

    public static function from(string $val): Action {
        return match($val) {
            "login" => Action::Login(),
            "logout" => Action::Logout(),
            "order" => Action::Order(),
            "insert" => Action::Insert(),
            "delete" => Action::Delete(),
            "update" => Action::Update(),
            default => throw new ValueError("unexpected value")
        };
    }

}

class AuditLog {
    // Properties match the database columns for data storage
    // Note:
    //  ? at type indicates the property can be null
    
    public ?int $id; 
    public string $time;
    public Action $action;
    public string $target;
    public ?string $effect; 

    public function __construct(?int $id, Action $action, string $target, ?string $effect) {
        $this->id = $id;
        $this->time = (new DateTime())->format("Y-m-d H:i:s");
        $this->action = $action;
        $this->target = $target;
        $this->effect = $effect;
    }
}
