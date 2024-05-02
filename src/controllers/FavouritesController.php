<?php

require_once 'ContentController.php';

class FavouritesController extends ContentController {
    private static $instance = null;

    private function __construct() {
        parent::__construct();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new FavouritesController();
        }
        return self::$instance;
    }
    
    public function favourites() {
        $this->render('favourites');
    }
}
