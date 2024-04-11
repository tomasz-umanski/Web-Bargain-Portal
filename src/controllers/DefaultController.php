<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    private const HOT = "Hot";
    private const NEW_OPTION = "New";
    private const LAST_CALL = "Last Call";
    
    private const URL_HOT = "/";
    private const URL_NEW = "/new";
    private const URL_LAST_CALL = "/lastCall";

    private function renderHomePage($selectedOptionName, $options) {
        $subnavContent = [
            "selectedOptionName" => $selectedOptionName,
            "options" => $options
        ];
        $this->render('home-page', ['subnavContent' => $subnavContent]);
    }

    public function index() {
        $options = [
            ["url" => self::URL_NEW, "name" => self::NEW_OPTION],
            ["url" => self::URL_LAST_CALL, "name" => self::LAST_CALL]
        ];
        $this->renderHomePage(self::HOT, $options);
    }

    public function new() {
        $options = [
            ["url" => self::URL_HOT, "name" => self::HOT],
            ["url" => self::URL_LAST_CALL, "name" => self::LAST_CALL]
        ];
        $this->renderHomePage(self::NEW_OPTION, $options);
    }

    public function lastCall() {
        $options = [
            ["url" => self::URL_HOT, "name" => self::HOT],
            ["url" => self::URL_NEW, "name" => self::NEW_OPTION]
        ];
        $this->renderHomePage(self::LAST_CALL, $options);
    }
}