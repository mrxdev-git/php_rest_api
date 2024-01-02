<?php
namespace DataEx\Routing;

use DataEx\Response\ResponseFormatter;

class Route404 implements IRoute {

	public function run()
	{
		$response = new ResponseFormatter();
		$response->sendError('Page not found', 404);
	}

}