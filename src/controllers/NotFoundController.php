<?php

require_once 'ContentController.php';

class NotFoundController extends ContentController {
    private static $instance = null;

    private function __construct() {
        parent::__construct();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new NotFoundController();
        }
        return self::$instance;
    }

    public function renderNotFoundPage() {
        $this->render('not-found');
    }
}