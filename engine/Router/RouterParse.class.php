<?php 
namespace Engine\Router;

use Engine\Router\RouterHelper;

class RouterParse extends Router
{
	private $url;	

	public function parseURL(array $routes) 
	{
    	$this->url['uri'] = substr($_SERVER['REQUEST_URI'], 1);
    	$this->url['uri'] = trim($this->url['uri'], '/');
    	$expURI = explode('/', $this->url['uri']);

    	$this->url['controller'] = 'Index';

    	foreach($routes as $routes) {
    		foreach($routes as $route => $controller) {
				if(preg_match('#'.$this->convertRoute($route).'#', $this->url['uri'], $matches)) {
					//$this->args
					//var_dump($matches); die();
					//var_dump($this->args);
			
					$this->readController($controller);
					break;
				} 
    		}
    	}

    	//if($this->url['controller'] != 'Index')  
	}	

	public function getURL(string $name = null) 
	{
		if(is_null($name)) 
			return $this->url;
		else return (isset($this->url[$name])) ? $this->url[$name] : false;
	}

	private function readController(string $controller) 
	{
		if(strpos($controller, '@')){ // if we have method
			$expController = explode('@', $controller);
			$this->url['controller'] = $expController[0];
			$this->url['method'] = $expController[1];
		} else $this->url['controller'] = $controller;		
	} 

    private function convertRoute($route)
    {
        if (strpos($route, '{') === false)
        	return trim($route, '/');

        return trim(preg_replace_callback('#{(\w+):(\w+)}#', 
              array($this, 'replaceRoute'), $route), '/');
    }

    private function replaceRoute($match)
    {
		//var_dump($match);

        $name = $match[1];    
        $pattern = $match[2];

        for($i=1; $i<count($match); $i++) {
        	$this->url['params'][$match[$i]] = null;
        }

        $replaced = str_replace($this->routerPattern, $this->routerReplace, $pattern);

        return $replaced;
    }    		
}