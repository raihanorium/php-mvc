<?php
namespace app\controllers;

use core\Controller;

/**
 * @hasAnyRole(reseller, admin)
 */
class HomeController extends Controller {
    public function index($request) {
        $this->view->renderTemplate(array('hello' => 'This message is comming from index function of HomeController'));
    }
}