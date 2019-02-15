<?php 
namespace Engine;

/**
*	Server request class
*/
class Request {

	/**
	*	Send response code
	*
	*	@param $code response code
	*	@return void
	*	@todo add view
	*/
	public static function code(int $code): void {
		http_response_code($code);
		// replace view
		echo $code;
		exit(); 
	}

	/**
	*	Redirect to page
	*
	*	@param $url redirect URL
	*	@return void
	*/
	public static function redirect(string $url): void {
		header('Location: '.$url);
	}
}