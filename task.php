<?php
// task.php

// task.php

class Task {
    public $id;
    public $due_date;
    public $description;
    public $priority;

    public function __construct($id, $due_date, $description, $priority) {
        $this->id = $id;
        $this->due_date = $due_date;
        $this->description = $description;
        $this->priority = $priority;
    }
}


?>