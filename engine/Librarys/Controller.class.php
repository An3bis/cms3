<?php 
namespace Engine;

/**
 * Controller class
 */
class Controller 
{

	/**
	*	RouterHelper
	*
	*	@var object RouterHelper
	*/	
	private $router;

	/**
	*	Constructor
	*/
	public function __construct() 
	{
		$this->router = Container::get('Router');
	}

	/**
	*	Load controller and action
	*
	*	@throws Exception
	*	@return void
	*/	
	public function loadController(): void 
	{
		$this->includeController($this->router->getURL('controller'));
		$controllerName = 'Controller\\'.$this->router->getURL('controller');

		if(class_exists($controllerName)){
			$controller = new $controllerName();

			if(!is_null($this->router->getURL('method')) && method_exists($controller, $this->router->getURL('method')))
				$controller->{$this->router->getURL('method')}($this->router->getURL('params'));
		} else throw new \Exception('Class not found');			
	}

	/**
	*	Include controller
	*
	*	@param string $controller
	*	@throws Exception
	*	@return void
	*/	
	protected function includeController(string $controller): void 
	{
		if(file_exists($this->getControllerPath($controller)))
			require_once $this->getControllerPath($controller);
		else throw new \Exception('File doesnt exists');		
	}

	/**
	*	Get path of the controller
	*
	*	@param string $controller
	*	@throws Exception
	*	@return string
	*/	
	protected function getControllerPath(string $controller): string 
	{
		return ROOT.'engine/App/Http/Controllers/'.$controller.'.controller.php';
	}	
}