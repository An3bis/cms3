<?php 
namespace Engine; 

use Engine\Router\Router;
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
		// parse url
		$parse = new RouterParse;
		$routes = require_once(ROOT.'engine/Config/routes.config.php');
		$parse->run($routes);

		// require controller
		$controller = new Controller;
		$controller->loadController($parse->getURL('controller'));

		// var controller name
		$controllerClassName = 'Controller\\'.$parse->getURL('controller');

		// load controller
		if(class_exists($controllerClassName)){
			$controller = new $controllerClassName();

			if(!is_null($parse->getURL('method')))
				if(method_exists($controller, $parse->getURL('method')))
					if(!is_null($parse->getURL('params')))
						$controller->{$parse->getURL('method')}($parse->getURL('params'));
					else throw new \Exception('Not enough arguments');
		} else throw new \Exception('Class not found');	
	}
}