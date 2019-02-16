<?php 
namespace Engine\Router;

use Engine\Router\Router;
use Engine\Helper;
use Engine\Request;

/**
*	Parse URL and Routes
*/
class RouterParse extends Router {

	/**
	*	Keep url params
	*
	*	@var array $url
	*/
	private $url;	

	/**
	*	Routes
	*
	*	@var array $routes
	*/
	private $routes;

	/**
	*	Constructor
	*/
	public function __construct() {
		$this->routes = require_once(ROOT.'engine/App/Web/Routes.php');
	}

	/**
	*	Parse url and fill $url
	*
	*	@return void
	*/
	public function parseUrl(): void {
		$this->readUri();
    	$this->readParams();
    	$this->checkIndex();  
	}	

	/**
	*	Check index controller 
	*
	*	@return void
	*/
	private function checkIndex(): void {
		if(is_null($this->url['controller'])){
			$expURL = explode('/', $this->url['uri']);
			if($expURL[0] == '')
				$this->url['controller'] = 'Index';
			else Request::code(404);
		}		
	}

	/**
	*	Parse uri
	*
	*	@return void
	*/
	private function readUri(): void {
    	$this->url['uri'] = substr($_SERVER['REQUEST_URI'], 1);
    	$this->url['uri'] = trim($this->url['uri'], '/');		
	}

	/**
	*	Read params from route
	*
	*	@return array
	*/
	private function readParams() {
    	foreach($this->routes as $routes) {
    		foreach($routes as $route => $controller) {
				if(preg_match('#'.$this->convertRoute($route).'#', $this->url['uri'], $matches)) {
					unset($matches[0]);
					if(!empty($matches))
						$this->url['params'] = array_combine(array_keys($this->url['params']), Helper::prepareArray($matches));
					$this->readController($controller);
					break;
				} 
    		}
    	}		
	}

	/**
	*	Get class variable
	*
	*	@param string $name
	*	@return ?string
	*/	
	public function getURL(string $name = null) {
		if(is_null($name)) 
			return $this->url;
		else return (isset($this->url[$name])) ? $this->url[$name] : null;
	}

	/**
	*	Read controller and method from routes
	*
	*	@param string $controller
	*	@return void
	*/
	private function readController(string $controller): void {
		if(strpos($controller, '@')){ // if we have method
			$expController = explode('@', $controller);
			$this->url['controller'] = $expController[0];
			$this->url['method'] = $expController[1];
		} else $this->url['controller'] = $controller;		
	} 

	/**
	*	Convert routes to normal view
	*
	*	@param string $route
	*	@return string
	*/
    private function convertRoute(string $route): string {
        if (strpos($route, '{') === false)
        	return trim($route, '/');
        $this->url['params'] = null; // clear befor cycle
        return trim(preg_replace_callback('#{(\w+):(\w+)}#', 
              array($this, 'replaceRoute'), $route), '/');
    }

	/**
	*	Replace routes pattern
	*
	*	@param array $match
	*	@return string
	*/
    private function replaceRoute(array $match): string {
        $name = $match[1];    
        $pattern = $match[2];
        for($i=1; $i<count($match); $i++)
        	$this->url['params'][$match[1]] = null;
        $replaced = str_replace($this->routerPattern, $this->routerReplace, $pattern);
        return $replaced;
    }    		
}