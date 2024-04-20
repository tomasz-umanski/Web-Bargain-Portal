<?php

require_once 'ContentController.php';

class NotFoundController extends ContentController {

    public function renderNotFoundPage() {
        $this->render('not-found');
    }
}