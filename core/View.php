<?php
namespace core;

class View{
	public function __construct(){
		
	}

	public function render($value){
		echo $value;
	}

	public function renderTemplate($model){
		$viewName = strtolower(basename(debug_backtrace()[1]['class'], 'Controller'));
		$action = debug_backtrace()[1]['function'];

		$viewPath = 'app/views/' . $viewName . '/' . $action . '.php';
		
		ob_start();
		include $viewPath;
		$templateOutput = ob_get_clean();

		$arr = simplexml_load_string($templateOutput)->layoutsection;
		foreach ($arr as $section) {
			$key = (string)$section['name'];
			$value = $section;
			$LAYOUT_SECTION[$key] = $value;
		}

		require_once('app/views/layout.php');
	}
}