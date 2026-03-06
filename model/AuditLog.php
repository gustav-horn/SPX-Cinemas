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

class AuditLog implements Auditable {
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

    public function repr(): string {
        $action = $this->action->value;
        return "AuditLog(id = $this->id, time = $this->time, action = $action, target = $this->target, effect = $this->effect)";
    }

    public function name(): string {
        return "AuditLog";
    }
}
