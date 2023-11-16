<?php

namespace Model;

class Task extends ActiveRecord{
    protected static $table = "tasks";
    protected static $dbColumns = ["id", "name", "state", "projectId"];

    public $id;
    public $name;
    public $state;
    public $projectId;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->name = $args["name"] ?? '';
        $this->state = $args["state"] ?? 0; //Default state of each task is 0 that this significate that the task is pending
        $this->projectId = $args["projectId"] ?? '';
    }
}