<?php
namespace core;

class View{
	private $VIEW_PATH_PREFIX = 'app/views/';
	private $VIEW_PATH_SUFFIX = '.php';

	public function __construct(){
		
	}

	public function render($value){
		echo $value;
	}

	public function renderTemplate($model = null){
		$viewName = strtolower(basename(debug_backtrace()[1]['class'], 'Controller'));
		$action = debug_backtrace()[1]['function'];

		$viewPath = $this->VIEW_PATH_PREFIX . $viewName . '/' . $action . $this->VIEW_PATH_SUFFIX;
		
		$this->_renderLayout($viewPath, $model);
	}

	public function renderView($viewPath, $model = null){
		$viewPath = $this->VIEW_PATH_PREFIX . $viewPath . $this->VIEW_PATH_SUFFIX;
		$this->_renderLayout($viewPath, $model);
	}

	private function _renderLayout($viewPath, $model = null){
		ob_start();
		include $viewPath;
		$templateOutput = ob_get_clean();

		$LAYOUT_SECTION = array();
		$xmlNodes = simplexml_load_string($templateOutput);
		$arr = $xmlNodes->layoutsection;
		foreach ($arr as $section) {
			$key = (string)$section['name'];
			$value = $section;
			$LAYOUT_SECTION[$key] = $value;
		}

		$layoutName = $xmlNodes->layout;
		
		if($layoutName){
			require_once('app/views/' . $layoutName . '.php');
		} else{
			require_once('app/views/layout.php');
		}
	}
}