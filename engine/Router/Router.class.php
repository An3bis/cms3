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

    public function addRule(string $pattern, string $replace)
    {
        if(!isset($this->routerPattern[$pattern]) && !isset($routerReplace[$replace]))
    	   array_push($this->routerPattern, $this->routeReplace);
        else throw new \Exception('Rule already exists!');
    }

    public function addRoute(string $url, string $controller, string $type = 'GET') 
    {
        if($type == 'GET')
            $routes['GET'][$url] = $controller;
        else $routes[$type][$url] = $controller;
    }    		
}