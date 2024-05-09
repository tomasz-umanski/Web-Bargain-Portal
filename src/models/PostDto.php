<?php

class PostDto implements \JsonSerializable {
    private $id;
    private $title;
    private $description;
    private $newPrice;
    private $oldPrice;
    private $deliveryPrice;
    private $likesCount;
    private $offerUrl;
    private $imageUrl;
    private $creationDateDiff;
    private $endDateDiff;
    private $userName;
    private $categoryName;
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
        $creationDate,
        $endDate,
        $userName,
        $categoryName,
        $status
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->newPrice = $newPrice;
        $this->oldPrice = $oldPrice;
        $this->deliveryPrice = $this->determineDeliveryPriceString($deliveryPrice);
        $this->likesCount = $likesCount;
        $this->offerUrl = $offerUrl;
        $this->imageUrl = $imageUrl;
        $this->creationDateDiff = $this->toDiffDateString($creationDate);
        $this->endDateDiff = $this->toDiffDateString($endDate);
        $this->userName = $userName;
        $this->categoryName = $categoryName;
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

    public function getCreationDateDiff() {
        return $this->creationDateDiff;
    }

    public function getEndDateDiff() {
        return $this->endDateDiff;
    }

    public function getUserName() {
        return $this->userName;
    }

    public function getCategoryName() {
        return $this->categoryName;
    }

    public function getStatus() {
        return $this->status;
    }

    private function toDiffDateString($dateString): string {
        $date = new DateTime($dateString);
        $currentDate = new DateTime();
        $interval = $date->diff($currentDate);
        $totalHours = $interval->days * 24 + $interval->h;
        $totalMinutes = $totalHours * 60 + $interval->i;
        if ($interval->days > 0) {
            return "$interval->days d $interval->h h";
        } elseif ($totalHours > 0) {
            return "$totalHours h $interval->i min";
        } else {
            return "$totalMinutes min";
        }
    }
    

    private function determineDeliveryPriceString($deliveryPrice): string {
        return ($deliveryPrice == 0) ? 'Free delivery' : $deliveryPrice . ' zł';
    }

    public function jsonSerialize() {
        $vars = get_object_vars($this);

        return $vars;
    }
}
