<?php
namespace app\controllers;

use core\Controller;

class HomeController extends Controller{
	public function index($request){
		$this->view->renderTemplate(array('hello' => 'This message is comming from index function of HomeController'));
		// $this->view->renderView('login/index');
	}
}