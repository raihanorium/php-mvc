<?php
namespace app\controllers;

use core\Controller;
use core\Security;

class LoginController extends Controller {
    public function index($request) {
        $this->view->renderTemplate($request);
    }

    public function login($request) {
        Security::login($request['userName'], $request['password']);
    }
}