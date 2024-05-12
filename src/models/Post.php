<?php

class Post {
    private $id;
    private $title;
    private $description;
    private $newPrice;
    private $oldPrice;
    private $deliveryPrice;
    private $likesCount;
    private $offerUrl;
    private $imageUrl;
    private $endDate;
    private $userId;
    private $categoryId;
    private $status;

    public function __construct(
        $id, 
        $title, 
        $description, 
        $newPrice, 
        $oldPrice, 
        $deliveryPrice, 
        $likesCount, 
        $offerUrl, 
        $imageUrl, 
        $endDate, 
        $userId, 
        $categoryId, 
        $status
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->newPrice = $newPrice;
        $this->oldPrice = $oldPrice;
        $this->deliveryPrice = $deliveryPrice;
        $this->likesCount = $likesCount;
        $this->offerUrl = $offerUrl;
        $this->imageUrl = $imageUrl;
        $this->endDate = $endDate;
        $this->userId = $userId;
        $this->categoryId = $categoryId;
        $this->status = $status;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getNewPrice() {
        return $this->newPrice;
    }

    public function getOldPrice() {
        return $this->oldPrice;
    }

    public function getDeliveryPrice() {
        return $this->deliveryPrice;
    }

    public function getLikesCount() {
        return $this->likesCount;
    }

    public function getOfferUrl() {
        return $this->offerUrl;
    }

    public function getImageUrl() {
        return $this->imageUrl;
    }

    public function getEndDate() {
        return $this->endDate;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getCategoryId() {
        return $this->categoryId;
    }

    public function getStatus() {
        return $this->status;
    }
}