<?php
// Model/AuditLog.php

require_once __DIR__ . "/../utilities/Auditer.php";

enum Action: string {
    case Login = "login";
    case Logout = "logout";
    case Insert = "insert";
    case Delete = "delete";
    case Update = "update";
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
        $this->time = new DateTime()->format("Y-m-d H:i:s");
        $this->action = $action;
        $this->target = $target;
        $this->effect = $effect;
    }
}
