<?php

class Post {
    private $id;
    private $title;
    private $description;
    private $oldPrice;
    private $newPrice;
    private $deliveryPrice;
    private $likesCount;
    private $offerUrl;
    private $imageUrl;
    private $creationDate;
    private $endDate;
    private $createdBy;

    public function __construct($title, $description, $oldPrice, $newPrice, $deliveryPrice, $likesCount, $offerUrl, $imageUrl, $creationDate, $endDate, $createdBy) {
        $this->title = $title;
        $this->description = $description;
        $this->oldPrice = $oldPrice;
        $this->newPrice = $newPrice;
        $this->deliveryPrice = $deliveryPrice;
        $this->likesCount = $likesCount;
        $this->offerUrl = $offerUrl;
        $this->imageUrl = $imageUrl;
        $this->creationDate = $creationDate;
        $this->endDate = $endDate;
        $this->createdBy = $createdBy;
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

    public function getOldPrice() {
        return $this->oldPrice;
    }

    public function getNewPrice() {
        return $this->newPrice;
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

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function getEndDate() {
        return $this->endDate;
    }

    public function getCreatedBy() {
        return $this->createdBy;
    }
}