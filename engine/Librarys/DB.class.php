<?php 
namespace Engine\Librarys;

class DB 
{
	private static $db = null;

	private function __construct() {}
	private function __clone() {}

	public static function query(string $query): void 
	{
		self::isConnected();
		if(self::$db->query($query) === false)
			throw new \PDOException('Query returned false.');	
	} 

	public function queryArr(string $query, array $columns): void 
	{
		self::isConnected();
		if($sql = self::$db->prepare($query)->execute($columns) !== false)
			$sql->fetchAll(PDO::FETCH_ASSOC);
		else throw new \PDOException('queryArr returned false.');	
	}

	private function isConnected(): void 
	{
		if(is_null(self::$db))
			self::connect();
	}

	private static function connect(): void 
	{
		$dbconfig = require_once ROOT.'engine/Config/db.config.php';
		self::$db = new \PDO('mysql:host='.$dbconfig['db_host'].';dbname='.$dbconfig['db_base'], $dbconfig['db_user'], $dbconfig['db_pass'], $dbconfig['params']);
	}

	private function disconnect(): void 
	{
		self::$db = null;
	}
}