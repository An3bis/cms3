<?php 
namespace Engine\Router;

class RouterHelper
{
 	public function prepareString(string $string) : string
	{
		$var = htmlentities(strtolower($string));
		return ucfirst($var);
	}
}