<?php

require_once __DIR__ . '/../repository/PostRepository.php';
require_once __DIR__ . '/../models/Post.php';
require_once __DIR__ . '/../models/PostDto.php';

class PostService {
    private $postRepository;
    
    public function __construct() {
        $this->postRepository = new PostRepository();
    }

    public function getHotPosts() {
        return $this->postRepository->getHotPosts();
    }

    public function getNewPosts() {
        return $this->postRepository->getNewPosts();
    }

    public function getLastCallPosts() {
        return $this->postRepository->getLastCallPosts();
    }

    public function getPostsByCategory($categoryId) :?array {
        return $this->postRepository->getPostsByCategory($categoryId);
    }

    public function createPostAttempt($offerUrl, $title, $categoryId, $newPrice, $oldPrice, $deliveryPrice, $endDate, $description, $imageUrl) : void {
        $user = Session::get('user');
        $status = 'pending';

        $post = $post = new Post(
            null, 
            $title, 
            $description, 
            $newPrice, 
            $oldPrice, 
            $deliveryPrice, 
            0, 
            $offerUrl, 
            $imageUrl, 
            new DateTime(), 
            new DateTime($endDate), 
            $user['id'], 
            $categoryId, 
            $status
        );

        try {
            $this->postRepository->createPost($post);
            Session::flash('postCreationMessage', 'Your post has been submitted successfully! It is now pending approval by the admin.');
        } catch (Exception $e) {
            Session::flash('postCreationMessage', 'Failed to create post! Please try again later or contact support for assistance.');
        }
    }

    public function togglePostLike(int $postId): void {
        $userId = Session::get('user')['id'];
        
        try {
            $action = $this->postRepository->togglePostLike($postId, $userId);
            $response = ['action' => $action];
            $statusCode = 200;
        } catch (Exception $e) {
            $response = ['error' => 'Internal Server Error'];
            $statusCode = 500;
        }
        
        http_response_code($statusCode);
        echo json_encode($response);
    }
    
    public function getPostLikeStatus(int $postId): void {
        $userId = Session::get('user')['id'];
        $isLiked = false;
    
        if ($userId !== null) {
            try {
                $isLiked = $this->postRepository->getPostLikeStatus($postId, $userId);
            } catch (Exception $e) {
                $response = ['error' => 'Internal Server Error'];
                $statusCode = 500;
            }
        }
    
        $response = ['isLiked' => $isLiked ?? false];
        $statusCode = 200;
    
        http_response_code($statusCode);
        echo json_encode($response);
    }

    public function togglePostFavourite(int $postId): void {
        $userId = Session::get('user')['id'];
        
        try {
            $action = $this->postRepository->togglePostFavourite($postId, $userId);
            $response = ['action' => $action];
            $statusCode = 200;
        } catch (Exception $e) {
            $response = ['error' => 'Internal Server Error'];
            $statusCode = 500;
        }
        
        http_response_code($statusCode);
        echo json_encode($response);
    }
    
    public function getPostFavouriteStatus(int $postId): void {
        $userId = Session::get('user')['id'];
        $isFavourite = false;
    
        if ($userId !== null) {
            try {
                $isFavourite = $this->postRepository->getPostFavouriteStatus($postId, $userId);
            } catch (Exception $e) {
                $response = ['error' => 'Internal Server Error'];
                $statusCode = 500;
            }
        }
    
        $response = ['isFavourite' => $isFavourite ?? false];
        $statusCode = 200;
    
        http_response_code($statusCode);
        echo json_encode($response);
    }
}