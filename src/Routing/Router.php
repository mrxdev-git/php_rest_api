<?php
namespace DataEx\Routing;

class Router {

	protected static array $routes = [];

	private ?IRoute $route = null;

	public function dispatch($uri, $method)
	{
		$this->resolve($uri, $method);
		$this->route->run();
	}

	private function resolve($uri, $method)
	{
		$this->route = isset(self::$routes[$method . ':' . $uri])
			   ? new Route(...self::$routes[$method . ':' . $uri])
			   : new Route404();
	}

	public static function __callStatic($server_method, $args)
	{
		$server_method = strtolower($server_method);
		[$uri, $handler] = $args;

		if (is_array($handler) && !isset($handler[1])){
			$handler[1] = 'execute';
		}

		self::$routes[$server_method . ':' . $uri] = [
			   'uri'     => $uri,
			   'handler' => $handler
		];
	}

}