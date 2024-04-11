<?php

require_once 'AppController.php';

class NotFoundController extends AppController {

    public function renderNotFoundPage() {
        $this->render('not-found');
    }
}