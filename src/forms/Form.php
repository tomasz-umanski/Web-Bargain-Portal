<?php

require_once __DIR__ . '/../exceptions/ValidationException.php';

class Form {
    protected $errors = [];
    protected $attributes = [];

    public static function validate($attributes) {
        $instance = new static($attributes);
        return $instance->failed() ? $instance->throw() : $instance;
    }

    public function __construct($attributes) {
        $this->attributes = $attributes;
    }

    public function throw() {
        ValidationException::throw($this->errors, $this->attributes);
    }

    public function failed() {
        return count($this->errors);
    }

    public function errors() {
        return $this->errors;
    }

    public function error($field, $message) {
        $this->errors[$field] = $message;

        return $this;
    }
}