<?php

require_once 'ContentController.php';
require_once __DIR__ . '/../models/Post.php';
require_once __DIR__ . '/../repository/PostRepository.php';

class HomeController extends ContentController {
    private const HOT = "Hot";
    private const NEW = "New";
    private const LAST_CALL = "Last Call";
    
    private const URL_HOT = "/";
    private const URL_NEW = "/new";
    private const URL_LAST_CALL = "/lastCall";

    private function renderHomePage($selectedOptionName, $options, $posts) {
        $subnavContent = [
            "selectedOptionName" => $selectedOptionName,
            "options" => $options
        ];
        $this->render('home-page', ['subnavContent' => $subnavContent, 'posts' => $posts]);
    }

    public function index() {
        $posts = $this->postRepository->getHotPosts();
        $options = [
            ["url" => self::URL_NEW, "name" => self::NEW],
            ["url" => self::URL_LAST_CALL, "name" => self::LAST_CALL]
        ];
        $this->renderHomePage(self::HOT, $options, $posts);
    }

    public function new() {
        $posts = $this->postRepository->getNewPosts();
        $options = [
            ["url" => self::URL_HOT, "name" => self::HOT],
            ["url" => self::URL_LAST_CALL, "name" => self::LAST_CALL]
        ];
        $this->renderHomePage(self::NEW, $options, $posts);
    }

    public function lastCall() {
        $posts = $this->postRepository->getLastCallPosts();
        $options = [
            ["url" => self::URL_HOT, "name" => self::HOT],
            ["url" => self::URL_NEW, "name" => self::NEW]
        ];
        $this->renderHomePage(self::LAST_CALL, $options, $posts);
    }
}