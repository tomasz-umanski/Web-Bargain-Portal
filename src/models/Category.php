<?php

class Category {
    private $id;
    private $name;
    private $url;
    private $icon;

    public function __construct($id, $name, $url, $icon) {
        $this->id = $id;
        $this->name = $name;
        $this->url = $url;
        $this->icon = $icon;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getUrl() {
        return $this->url;
    }

    public function getIcon() {
        return $this->icon;
    }
}
