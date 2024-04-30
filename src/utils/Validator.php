<?php

class Validator { 
    const MAX_FILE_SIZE = 2 * 1024 * 1024;

    public static function string($value, $min = 1, $max = INF): bool {
        $value = trim($value);
        $length = strlen($value);
        return $length >= $min && $length <= $max;
    }

    public static function email(string $value): bool {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function url(string $value): bool {
        return filter_var($value, FILTER_VALIDATE_URL) !== false;
    }

    public static function price($value, $positiveOnly = false, $allowTwoDecimal = false, $max = 10000000): bool {
        if (!is_numeric($value) || $value === '') {
            return false;
        }
        
        if ($allowTwoDecimal && !preg_match('/^\d+(\.\d{1,2})?$/', $value)) {
            return false;
        }
    
        $numericValue = (float) $value;
        if ($positiveOnly && $numericValue < 0) {
            return false;
        }
        
        return $numericValue <= $max;
    }

    public static function date($value): bool {
        if ($value === null || $value === '') {
            return false;
        }
        
        $currentDateTime = new DateTime();
        $givenDateTime = new DateTime($value);
        
        return $givenDateTime > $currentDateTime;
    }
    
    public static function file($file): bool {
        if(!is_uploaded_file($file['tmp_name'])) {
            return false;
        }

        if ($file['size'] > self::MAX_FILE_SIZE) {
            return false;
        }

        if (!isset($file['type'])) {
            return false;
        }

        return true;
    }
}
