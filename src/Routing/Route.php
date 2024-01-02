<?php
namespace DataEx\Routing;

class Route implements IRoute
{
	protected string $uri;
	protected $handler;

	public function __construct($uri, $handler)
	{
		$this->uri = $uri;
		$this->handler = $handler;
	}

	public function run()
	{
		call_user_func($this->handler);
	}
}