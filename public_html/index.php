<?php
// config
require_once '../config/server.config.php';
require_once ROOT.'vendor/autoload.php';

try {
	$router = new Engine\Router\Router;
	$router->run();
} catch (PDOExeption | Exception $e){
	exit($e->getMessage());
}