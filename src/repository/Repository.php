<?php

require_once __DIR__.'/../../core/Database.php';

class Repository {
    protected $database;

    public function __construct() {
        $this->database = Database::getInstance();
    }
}