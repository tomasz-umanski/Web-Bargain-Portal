<?php

require_once 'ContentController.php';

class AdminPanelController extends ContentController {
    private static $instance = null;

    private function __construct() {
        parent::__construct();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new AdminPanelController();
        }
        return self::$instance;
    }

    public function adminApproval() {
        $posts = $this->postService->getPostsToApprove();
        $this->render('admin-approval', ['posts' => $posts]);
    }
    
    public function approvePost(): void {
        $this->processPostAction('approve');
    }
    
    public function rejectPost(): void {
        $this->processPostAction('reject');
    }
    
    private function processPostAction(string $action): void {
        $postData = json_decode(file_get_contents('php://input'), true);
    
        if (!isset($postData['id']) || !isset($postData['lastUpdated'])) {
            http_response_code(400);
            echo json_encode(['error' => 'postId and lastUpdated are required']);
            return;
        }
    
        $postId = $postData['id'];
        $lastUpdated = $postData['lastUpdated'];
    
        if ($action !== 'approve' && $action !== 'reject') {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid action']);
            return;
        }
    
        $this->postService->processPostAttempt($postId, $lastUpdated, $action);
    }
}