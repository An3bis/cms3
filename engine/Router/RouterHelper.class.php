<?php 
namespace Engine\Router;

class RouterHelper
{
 	public static function prepareString(string $string) 
	{
		$var = htmlentities(strtolower($string));
		return ucfirst($var);
	}
}