<?php

class User {
    private $id;
    private $userName;
    private $email;
    private $password;

    public function __construct($id, $userName, $email, $password) {
        $this->id = $id;
        $this->userName = $userName;
        $this->email = $email;
        $this->password = $password;
    }

    public function setId($id) : void {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function getUserName() {
        return $this->userName;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }
}
