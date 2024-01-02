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
		if (isset(self::$routes[$method . ':' . $uri])){
			$route = self::$routes[$method . ':' . $uri];

			[$uri, $handler] = $route;

			if (is_array($handler) && isset($handler[0]) && !isset($handler[1])){
				$handler[1] = 'execute';
			}

			$this->route = new Route($uri, $handler);
		} else {
			$this->route = new Route404();
		}
	}

	public static function __callStatic($server_method, $args)
	{
		$server_method = strtolower($server_method);
		[$uri, $handler] = $args;

		self::$routes[$server_method . ':' . $uri] = [
			   'uri'     => $uri,
			   'handler' => $handler
		];
	}

}