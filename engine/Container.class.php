<?php 
namespace Engine;

/**
*	Dependency Injection container
*/
class Container {
	/**
	*	Container that keeps objects
	*
	*	@var array $container
	*/
	private static $container = [];

	/**
	*	Add new object to container
	*
	*	@param string $name
	*	@param object $obj
	*	@throws Exception
	*	@return void
	*/
	public static function add(string $name, object $obj): void {
		if(!isset(self::$container[$name]))
			self::$container[$name] = $obj;
		else throw new \Exception('This key already exists.');	
	}

	/**
	*	Add new object to container
	*
	*	@param string $name
	*	@param object $obj
	*	@throws Exception
	*	@return ?object	
	*/
	public static function get(string $name): ?object {
		if(isset(self::$container[$name]))
			return self::$container[$name];
		else throw new \Exception('This key didnt exists.');	
	}
}