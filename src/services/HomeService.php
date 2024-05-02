<?php

class HomeService {
    public const HOT = "Hot";
    public const NEW = "New";
    public const LAST_CALL = "Last Call";
    
    private const URL_HOT = "/";
    private const URL_NEW = "/new";
    private const URL_LAST_CALL = "/lastCall";
    

    public function getSubnavContent($selectedOptionName) {
        $options = [];
        switch ($selectedOptionName) {
            case self::HOT:
                $options = [
                    ["url" => self::URL_NEW, "name" => self::NEW],
                    ["url" => self::URL_LAST_CALL, "name" => self::LAST_CALL]
                ];
                break;
            case self::NEW:
                $options = [
                    ["url" => self::URL_HOT, "name" => self::HOT],
                    ["url" => self::URL_LAST_CALL, "name" => self::LAST_CALL]
                ];
                break;
            case self::LAST_CALL:
                $options = [
                    ["url" => self::URL_HOT, "name" => self::HOT],
                    ["url" => self::URL_NEW, "name" => self::NEW]
                ];
                break;
            default:
                break;
        }
        
        return [
            "selectedOptionName" => $selectedOptionName,
            "options" => $options
        ];
    }
}