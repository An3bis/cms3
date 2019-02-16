<?php 
namespace Engine\Router;

use Engine\Controller;

/**
* Main router
*/
class Router 
{
    /**
    *   Patterns for router
    *
    *   @var $routerPattern
    */
    protected $routerPattern = [
        'all',
        'nums',
        'chars'
    ];

    /**
    *   Replace for patterns
    *
    *   @var $routerPattern
    */
    protected $routerReplace = [
        '(.+)',
        '([0-9]+)',
        '([a-zA-Z]+)'
    ]; 

    /**
    *   Add new rule
    *
    *   @param string $pattern
    *   @param string $replace
    *   @return void
    */
    public function addRule(string $pattern, string $replace): void {
        if(!isset($this->routerPattern[$pattern]) && !isset($routerReplace[$replace]))
    	   array_push($this->routerPattern, $this->routeReplace);
        else throw new \Exception('Rule already exists!');
    }

    /**
    *   Add new rule
    *
    *   @param string $url
    *   @param string $controller
    *   @param string $type
    *   @return void
    */
    public function addRoute(string $url, string $controller, string $type = 'GET'): void {
        if($type == 'GET')
            $routes['GET'][$url] = $controller;
        else $routes[$type][$url] = $controller;
    }    		
}