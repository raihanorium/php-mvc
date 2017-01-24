<?php
require_once('core/Controller.php');
require_once('core/Security.php');
require_once('core/UserNotLoggedInException.php');
require_once('core/GlobalException.php');
require_once('core/LoginFailedException.php');
require_once('core/LoggerService.php');

use core\Security;
use services\LoggerService;

if(!isset($_SESSION)) session_start();

$vars = $_GET;
$request = $_REQUEST;

$controller = 'home';
$action = 'index';

// routing
if(isset($vars['p'])){
	$controller = $vars['p'];

	if(isset($vars['a'])){
		$action = $vars['a'];
	}
}

// logging request
LoggerService::Instance()->fileLog(sprintf('%s Request[/?p=%s&a=%s] IP[%s] User[%s]', date('d M Y h:i:s A'), $controller, $action, $_SERVER['REMOTE_ADDR'], Security::getLoggedInUser()['id']));

$controllerFileName = ucfirst($controller) . 'Controller';
$controllerFilePath = 'app/controllers/' . $controllerFileName . '.php';
if(file_exists($controllerFilePath)) {
    require_once($controllerFilePath);
    $controllerClassPath = 'app\\controllers\\' . $controllerFileName;
    $controller = new $controllerClassPath;

    if(method_exists($controller, $action)) {
        try {
            if (Security::checkPermission($controllerClassPath, $action)) {
                try {
                    $controller->$action($request);
                } catch (\core\GlobalException $ex){
                    echo($ex->getMessage());
                } catch (\core\LoginFailedException $ex){
                    $request['error'] = $ex->getMessage();
                    $controller->index($request);
                }
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