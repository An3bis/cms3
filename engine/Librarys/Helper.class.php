<?php 
namespace Engine;

/**
*	Helper for work with arrays and strings
*/
class Helper {

	/**
	*	Safe prepare array
	*
	*	@param array $arr
	*	@return array
	*/	
	public static function prepareArray(array $arr): array 
	{
		foreach($arr as $key)
			$tmp[] = self::prepareString($key);

		return $tmp;
	}

	/**
	*	Safe prepare string
	*
	*	@param string $arr
	*	@return string
	*/
	 public static function prepareString(string $string): string 
	 {
		return htmlentities($string);
	}	
}