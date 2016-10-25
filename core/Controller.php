<?php
namespace core;

class Controller{
	protected $view;
	
	function __construct(){
		require_once('View.php');
		$this->view = new View();
	}
}