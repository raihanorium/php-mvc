<?php
require_once('core/Controller.php');
require_once('core/Security.php');
require_once('core/UserNotLoggedInException.php');

use core\Security;

if(!isset($_SESSION)) session_start();

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
$controllerFilePath = 'app/controllers/' . $controllerFileName . '.php';
if(file_exists($controllerFilePath)) {
    require_once($controllerFilePath);
    $controllerClassPath = 'app\\controllers\\' . $controllerFileName;
    $controller = new $controllerClassPath;

    if(method_exists($controller, $action)) {
        try {
            if (Security::checkPermission($controllerClassPath, $action)) {
                $controller->$action($request);
            } else {
                echo '<h1>403: Unauthorized!</h1>';
            }
        } catch (\core\UserNotLoggedInException $ex){
            header("Location: ./?p=login");
            die();
        }
    } else{
        render404();
    }
} else{
    render404();
}

function render404(){
    $filePath = 'app/views/404.php';
    if(file_exists($filePath)){
        require_once $filePath;
    } else{
        echo '<h1>404: Not Found!</h1>';
    }
}