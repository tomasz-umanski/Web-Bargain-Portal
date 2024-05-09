<?php

require_once 'ContentController.php';

class SearchController extends ContentController {
    private static $instance = null;

    private function __construct() {
        parent::__construct();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new SearchController();
        }
        return self::$instance;
    }

    public function search() {
        $posts = $this->postService->getPostByQueryString();
    
        $serializedPosts = array();
        foreach ($posts as $post) {
            $serializedPosts[] = $post->jsonSerialize();
        }
    
        http_response_code(200);
        echo json_encode($serializedPosts);
    }
}
