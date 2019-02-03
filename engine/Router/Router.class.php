<?php 
namespace Engine\Router;

use Engine\Router\RouterParse;
use Engine\Controller;

class Router
{
    protected $routerPattern = [
        'all',
        'nums',
        'chars'
    ];

    protected $routerReplace = [
        '(.+)',
        '([0-9]+)',
        '([a-zA-Z]+)'
    ]; 

	protected $routes = [
		'GET' => [
			'/' 				=> 'Index',
			'/about/{id:nums}/' 	=> 'About@aboutCharact',
			'/about/' => 'About'
		]
	];

	public function run() 
	{
		// parse url
		$parse = new RouterParse;
		$parse->parseURL($this->routes);

		// require controller
		$controller = new Controller;
		$controller->loadController($parse->getURL('controller'));

		// var controller name
		$controllerClassName = 'Controller\\'.$parse->getURL('controller');

		// load method
		if(class_exists($controllerClassName)){
			$controller = new $controllerClassName();

			if(!is_null($parse->getURL('method')))
				if(method_exists($controller, $parse->getURL('method'))) 
					if(!is_null($parse->getURL('params')))
						$controller->{$parse->getURL('method')}($parse->getURL('params'));
					else throw new \Exception('Not enough arguments');
				else throw new \Exception('Method not found');
		} else throw new \Exception('Class not found');	
	}  	

    public function addRule(string $pattern, string $replace)
    {
    	array_push($this->routerPattern, $this->routeReplace);
    }

    public function addRoute(string $url, string $controller, string $type = 'GET') 
    {
        if($type == 'GET')
            $this->routes['GET'][$url] = $controller;
        else $this->routes[$type][$url] = $controller;
    }    		
}