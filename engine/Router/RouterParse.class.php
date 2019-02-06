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
    	$this->url['controller'] = null;

    	foreach($routes as $routes) {
    		foreach($routes as $route => $controller) {
				if(preg_match('#'.$this->convertRoute($route).'#', $this->url['uri'], $matches)) {
					unset($matches[0]);
					if(!empty($matches))
						$this->url['params'] = array_combine(array_keys($this->url['params']), RouterHelper::prepareArray($matches));
					$this->readController($controller);
					break;
				} 
    		}
    	}

    	if(is_null($this->url['controller']))
		{
			$expURL = explode('/', $this->url['uri']);
			if($expURL[0] == '')
				$this->url['controller'] = 'Index';
			else exit('404');
		}  
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

    private function convertRoute(string $route)
    {
        if (strpos($route, '{') === false)
        	return trim($route, '/');

        $this->url['params'] = null; // clear befor cycle

        return trim(preg_replace_callback('#{(\w+):(\w+)}#', 
              array($this, 'replaceRoute'), $route), '/');
    }

    private function replaceRoute(array $match)
    {
        $name = $match[1];    
        $pattern = $match[2];

        for($i=1; $i<count($match); $i++) {
        	$this->url['params'][$match[1]] = null;
        }

        $replaced = str_replace($this->routerPattern, $this->routerReplace, $pattern);

        return $replaced;
    }    		
}