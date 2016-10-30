<?php
require_once('core/Controller.php');

$vars = $_GET;
$request = $_REQUEST;

$controller = 'home';
$action = 'index';

if(isset($vars['p'])){
	$controller = $vars['p'];

	if(isset($vars['a'])){
		$action = $vars['a'];
	}
}

require_once('app/controllers/HomeController.php');
$controller = new app\controllers\HomeController();
$controller->index($request);
?>