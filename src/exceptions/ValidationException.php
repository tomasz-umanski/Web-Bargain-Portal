<?php

class ValidationException extends Exception {
    private $errors;
    private $old;

    public static function throw($errors, $old) {
       $instance = new static('The form failed to validate.');

       $instance->errors = $errors;
       $instance->old = $old;

       throw $instance;
    }

    public function getErrors() {
        return $this->errors;
    }

    public function getOld() {
        return $this->old;
    }
}
