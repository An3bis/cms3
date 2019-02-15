<?php 
namespace Engine;

class Controller{

	/**
	*	Load controller and action
	*
	*	@throws Exception
	*	@return void
	*/	
	public function loadController(): void {
		$parse = Container::get('Router');
		$this->includeController($parse->getURL('controller'));

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

	/**
	*	Include controller
	*
	*	@param string $controller
	*	@throws Exception
	*	@return void
	*/	
	private function includeController(string $controller): void {
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
	private function getControllerPath(string $controller): string {
		return ROOT.'engine/Controllers/'.$controller.'.controller.php';
	}	
}