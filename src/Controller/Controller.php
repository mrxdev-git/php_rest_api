<?php

namespace DataEx\Controller;

use Exception;
use DataEx\Response\ResponseFormatter;

abstract class Controller
{
	protected $response;

	public function __construct()
	{
		$this->response = new ResponseFormatter();
	}

	public function run()
	{
		try {
			$response = $this->process();
			$this->response->sendSuccess($response);
		} catch (Exception $e){
			$this->response->sendError($e->getMessage());
		}
	}

	abstract function process(): array;
}