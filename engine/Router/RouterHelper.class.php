<?php 
namespace Engine\Router;

class RouterHelper
{
	public static function prepareArray(array $arr)
	{
		$tmp = [];

		foreach($arr as $key)
			$tmp[] = self::prepareString($key);

		return $tmp;
	}

 	public static function prepareString(string $string) 
	{
		return htmlentities($string);
	}
}