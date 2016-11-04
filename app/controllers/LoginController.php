<?php
namespace app\controllers;

use core\Controller;

class LoginController extends Controller {
    public function index($request) {
        $this->view->renderTemplate($request);
    }
}