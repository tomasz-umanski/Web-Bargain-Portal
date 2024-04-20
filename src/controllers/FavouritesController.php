<?php

require_once 'ContentController.php';

class FavouritesController extends ContentController {
    private const FAVOURITE_CATEGORIES = "Favourite categories";
    private const FAVOURITE_SEARCHES = "Favourite searches";
    private const FAVOURITE_DEALS = "Favourite deals";

    private const URL_FAVOURITE_CATEGORIES = "favourites";
    private const URL_FAVOURITE_SEARCHES = "favouriteSearches";
    private const URL_FAVOURITE_DEALS = "favouriteDeals";

    protected function renderPage($selectedOptionName, $options) {
        $subnavContent = [
            "selectedOptionName" => $selectedOptionName,
            "options" => $options
        ];

        $this->render('favourites', ['subnavContent' => $subnavContent]);
    }

    public function favourites() {
        $options = [
            ["url" => self::URL_FAVOURITE_SEARCHES, "name" => self::FAVOURITE_SEARCHES],
            ["url" => self::URL_FAVOURITE_DEALS, "name" => self::FAVOURITE_DEALS]
        ];
        $this->renderPage(self::FAVOURITE_CATEGORIES, $options);
    }

    public function favouriteSearches() {
        $options = [
            ["url" => self::URL_FAVOURITE_CATEGORIES, "name" => self::FAVOURITE_CATEGORIES],
            ["url" => self::URL_FAVOURITE_DEALS, "name" => self::FAVOURITE_DEALS]
        ];
        $this->renderPage(self::FAVOURITE_SEARCHES, $options);
    }

    public function favouriteDeals() {
        $options = [
            ["url" => self::URL_FAVOURITE_CATEGORIES, "name" => self::FAVOURITE_CATEGORIES],
            ["url" => self::URL_FAVOURITE_SEARCHES, "name" => self::FAVOURITE_SEARCHES]
        ];
        $this->renderPage(self::FAVOURITE_DEALS, $options);
    }
}
