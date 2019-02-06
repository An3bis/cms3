<?php
// config
define('ROOT', realpath(dirname(__FILE__).'/../').'/');

require_once ROOT.'vendor/autoload.php';

try {
	$app = new \Engine\App;
	$app->run();
} catch (\PDOExeption | \Exception $e){
	exit($e->getMessage());
}