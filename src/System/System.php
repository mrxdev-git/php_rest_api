<?php

namespace DataEx\System;

define('BASE_DIR', realpath(dirname(__FILE__) . '/../../'));

use DataEx\Routing\Router;

class System
{
	private static ?System $instance = null;

	private Router $router;

	private function __construct(){
		$this->router = new Router();
	}

	private function __clone(){}

	public static function getInstance(): System
	{
		if (!isset(self::$instance)){
			self::$instance = new static();
		}

		return self::$instance;
	}

	public function boot()
	{
		$this->loadRoutes();
	}

	private function loadRoutes()
	{
		$file_path = BASE_DIR . '/config/routes.php';
		include($file_path);
	}

}