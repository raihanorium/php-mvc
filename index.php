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
$controllerFilePath = 'app/controllers/' . $controllerFileName . '.php';
if(file_exists($controllerFilePath)) {
    require_once($controllerFilePath);
    $controllerClassPath = 'app\\controllers\\' . $controllerFileName;
    $controller = new $controllerClassPath;

    if(method_exists($controller, $action)) {
        $controller->$action($request);
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