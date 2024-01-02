<?php
namespace DataEx\Routing;

use DataEx\Routing\Route;

class Router {

	protected static array $routes = [];

	public function dispatch($uri, $method)
	{
		$route = $this->getRoute($uri, $method);
		$route->run();
	}

	protected function resolve($uri, $method)
	{
		if (isset(self::$routes[$method . ':' . $uri])){
			return new Route(...self::$routes[$method . ':' . $uri]);
		}

		return new \Route404();
	}

	public static function __callStatic($server_method, $args)
	{
		$server_method = strtolower($server_method);
		list($uri, $handler) = $args;

		if (is_array($handler) && !isset($handler[1])){
			$handler[1] = 'execute';
		}

		self::$routes[$server_method . ':' . $uri] = [
			   'uri'     => $uri,
			   'handler' => $handler
		];
	}

}