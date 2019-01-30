<?php 
namespace Engine\Router;

use Engine\Router\RouterHelper;

class RouterParse extends Router
{
	private $url;	

	public function parseURL(array $routes) 
	{
		// explode url
		$helper = new RouterHelper;

    	$this->url['uri'] = substr($_SERVER['REQUEST_URI'], 1);
    	$this->url['uri'] = trim($this->url['uri'], '/');
    	$expURI = explode('/', $this->url['uri']);
    	$this->url['controller'] = $helper->prepareString($expURI[0]);

    	// if url == '/' load home
		if(empty($this->url['uri'])) 
			$this->url['controller'] = 'Index';  
		else { // if not home

	    	foreach($routes['GET'] as $route => $controller){
	    		$route = trim($route, '/');
	    		$expKey = explode('/', $route);	  		

	    		// equal controller in url with routes
	    		if($this->url['controller'] == $helper->prepareString($expKey[0])) {    			
					$routMatches = $this->readParams($route);

					if(!empty($routMatches))
						$this->url['params'] = array_column($routMatches,1);
					else $this->url['params'] = null;	 

		    		$this->readController($controller); // get controller and his method
		    		
		    		break; // stop foreach
		    	} 
	    	}
		}
	}	

	public function getURL(string $name = null) 
	{
		if(is_null($name)) 
			return $this->url;
		else return (isset($this->url[$name])) ? $this->url[$name] : null;
	}

	private function readController(string $controller) 
	{
		if(strpos($controller, '@')){ // if we have method
			$expController = explode('@', $controller);
			$this->url['controller'] = $expController[0];
			$this->url['method'] = $expController[1];
		} else $this->url['controller'] = $controller;		
	} 

	private function readParams(string $route) : array
	{
		if(strpos($route, '{')) { // if we have params
			$replacePlaceholders = str_replace($this->routerPattern, $this->routerReplace, $route);
			$replacementPattern = '#^'.$replacePlaceholders.'$#s';
			preg_match_all($replacementPattern, $this->url['uri'], $routMatches, PREG_SET_ORDER);
			return $routMatches;
		}		
	}		
}