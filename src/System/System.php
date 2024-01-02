<?php

namespace DataEx\System;

define('BASE_DIR', realpath(dirname(__FILE__) . '/../../'));

class System
{
	private static ?System $instance = null;

	private function __construct(){}
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