<?php

require_once 'ContentController.php';
require_once __DIR__ . '/../models/Post.php';
require_once __DIR__ . '/../repository/PostRepository.php';
require_once __DIR__ . '/../services/HomeService.php';

class HomeController extends ContentController {
    private static $instance = null;
    private $homeService;

    private function __construct() {
        parent::__construct();
        $this->homeService = new HomeService();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new HomeController();
        }
        return self::$instance;
    }

    public function index() {
        $posts = $this->postService->getHotPosts();
        $subnavContent = $this->homeService->getSubnavContent(HomeService::HOT);
        $this->render('home-page', ['subnavContent' => $subnavContent, 'posts' => $posts]);
    }

    public function new() {
        $posts = $this->postService->getNewPosts();
        $subnavContent = $this->homeService->getSubnavContent(HomeService::NEW);
        $this->render('home-page', ['subnavContent' => $subnavContent, 'posts' => $posts]);
    }

    public function lastCall() {
        $posts = $this->postService->getLastCallPosts();
        $subnavContent = $this->homeService->getSubnavContent(HomeService::LAST_CALL);
        $this->render('home-page', ['subnavContent' => $subnavContent, 'posts' => $posts]);
    }
}