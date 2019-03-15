<?php
/**
 * Паттерны проектирования:
 * - MVC
 * - Dependency Injection
 */

// config
declare(strict_types = 1);
define('ROOT', realpath(dirname(__FILE__).'/../').'/');

require_once ROOT.'vendor/autoload.php';
require_once ROOT.'engine/Config/main.config.php';

try {
	$app = new \Engine\App;
	$app->run();
} catch (\PDOExeption | \Exception $e){
	echo "<strong>Unexpected error:</strong> <br>";
	echo "<strong>File:</strong> {$e->getFile()} <br>";
	echo "<strong>Line:</strong> {$e->getLine()} <br>";
	echo "<strong>Message:</strong> {$e->getMessage()}";
	exit();
}