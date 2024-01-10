<?php
namespace DataEx\Routing;

class Router {

	protected static $routes = [];

	private $route;

	public function dispatch($uri, $method)
	{
		$this->resolve($uri, $method);
		$this->route->run();
	}

	private function resolve($uri, $method)
	{
		$method = strtolower($method);
		if (isset(self::$routes[$method . ':' . $uri])){
			$route = self::$routes[$method . ':' . $uri];

			['uri' => $uri, 'handler' => $handler] = $route;

			if (!$handler){
				throw new \Exception('Invalid route handler');
			}

			if (is_array($handler)){
				if (is_string($handler[0])) {
					$handler[0] = new $handler[0]();
				}

				if (!isset($handler[1])) {
					$handler[1] = 'run';
				}
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