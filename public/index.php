<?php
// config
declare(strict_types = 1);
define('ROOT', realpath(dirname(__FILE__).'/../').'/');

require_once ROOT.'vendor/autoload.php';
require_once ROOT.'engine/Config/main.config.php';

try {
	$app = new \Engine\App;
	$app->run();
} catch (\PDOExeption | \Exception $e){
	exit($e->getMessage());
}