<?php
namespace core;

class View{
	private $VIEW_PATH_PREFIX = 'app/views/';
	private $VIEW_PATH_SUFFIX = '.php';

	public function __construct(){
		
	}

	public function render($value){
		print_r($value);
	}

	public function renderTemplate($model = null){
        $a= debug_backtrace()[1]['class'];
        $viewName = strtolower(str_replace('Controller', '', explode('\\', $a)[sizeof($a) + 1]));
		$action = debug_backtrace()[1]['function'];

		$viewPath = $this->VIEW_PATH_PREFIX . $viewName . '/' . $action . $this->VIEW_PATH_SUFFIX;
		
		$this->_renderLayout($viewPath, $model);
	}

	public function renderView($viewPath, $model = null){
		$viewPath = $this->VIEW_PATH_PREFIX . $viewPath . $this->VIEW_PATH_SUFFIX;
		$this->_renderLayout($viewPath, $model);
	}

	public function redirectCurrentPath($request){
        header('Location: ./?p=' . $request['p'] . '&a=' . $request['a']);
    }

	private function _renderLayout($viewPath, $model = null){
		ob_start();
		include $viewPath;
		$templateOutput = ob_get_clean();

        // escape ampersand character for xml
        $templateOutput = str_replace('&', '&amp;', $templateOutput);

		$LAYOUT_SECTION = array();
		$xmlNodes = simplexml_load_string($templateOutput);
		$arr = $xmlNodes->layoutsection;
		foreach ($arr as $section) {
			$key = (string)$section['name'];
			$value = $this->SimpleXMLElement_innerXML($section);

            // return the escaped ampersand to & character
            $value = str_replace('&amp;', '&', $value);

			$LAYOUT_SECTION[$key] = $value;
		}

		$layoutName = $xmlNodes->layout;
		
		if($layoutName){
			require_once('app/views/' . $layoutName . '.php');
		} else{
			require_once('app/views/layout.php');
		}
	}

    private function SimpleXMLElement_innerXML($xml) {
        $innerXML= '';
        foreach (dom_import_simplexml($xml)->childNodes as $child)
        {
            $innerXML .= $child->ownerDocument->saveXML( $child );
        }
        return $innerXML;
    }
}