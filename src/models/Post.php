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
    private $creationDateDiff;
    private $endDate;
    private $endDateDiff;
    private $user;

    public function __construct($title, $description, $oldPrice, $newPrice, $deliveryPrice, $likesCount, $offerUrl, $imageUrl, $creationDateDiff, $endDateDiff, $user) {
        $this->title = $title;
        $this->description = $description;
        $this->oldPrice = $oldPrice;
        $this->newPrice = $newPrice;
        $this->deliveryPrice = $deliveryPrice;
        $this->likesCount = $likesCount;
        $this->offerUrl = $offerUrl;
        $this->imageUrl = $imageUrl;
        $this->creationDateDiff = $creationDateDiff;
        $this->endDateDiff = $endDateDiff;
        $this->user = $user;
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

    public function getCreationDateDiff() {
        return $this->creationDateDiff;
    }

    public function getEndDate() {
        return $this->endDate;
    }

    public function getEndDateDiff() {
        return $this->endDateDiff;
    }

    public function getUser() {
        return $this->user;
    }
}