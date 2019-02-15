<?php 
namespace Engine; 

use Engine\Router\RouterParse;

/**
*	Start application
*/
class App
{

	/**
	*	Run application
	*
	*	@throws Exception
	*	@return void
	*/	
	public function run(): void {
		Container::add('Router', (new RouterParse));
		Container::get('Router')->parseUrl();

		Container::add('Controller', (new Controller));
		Container::get('Controller')->loadController();
	}
}