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

$controllerFileName = ucfirst($controller) . 'Controller';
require_once('app/controllers/' . $controllerFileName . '.php');
$controllerClassPath = 'app\\controllers\\' . $controllerFileName;
$controller = new $controllerClassPath;
$controller->$action($request);
?>