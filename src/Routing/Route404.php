<?php
use DataEx\Response\ResponseFormatter;

class Route404 {

	public function run()
	{
		$response = new ResponseFormatter();
		$response->sendError('Page not found', 404);
	}

}