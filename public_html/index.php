<?php
// config
require_once '../config/server.config.php';
//require_once '../config/routes.config.php';
require_once ROOT.'engine/Router/Router.class.php';
require_once ROOT.'engine/Router/RouterHelper.class.php';
require_once ROOT.'engine/Router/RouterParse.class.php';
require_once ROOT.'engine/Controller.class.php';
require_once ROOT.'engine/DB.class.php';

try {
	$router = new Engine\Router\Router;
	$router->run();
} catch (PDOExeption | Exception $e){
	exit($e->getMessage());
}