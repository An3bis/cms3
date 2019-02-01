<?php 
namespace Engine\Model;

use PDO;

class DB {
	
	private static $host 		= "localhost";
	private static $base 		= "store";
	private static $user 		= "wembley";
	private static $pass 		= "wembley0372";
	private static $charset 	= "utf8";
	private static $settings	=	[	
									PDO::ATTR_ERRMODE 				=> PDO::ERRMODE_EXCEPTION,
									PDO::ATTR_DEFAULT_FETCH_MODE 	=> PDO::FETCH_ASSOC,
									PDO::ATTR_EMULATE_PREPARES 		=> false
									];
								
	private static $db 			= null;  // connection	 
	
	public static function getValue(string $query, array $params, $default = null)
	{
		self::connect();
		$result = self::getRow($query, $params);
		if (!empty($result)) 
			$result = array_shift($result);
			
		return (empty($result)) ? $default : $result;  
	}	
	
    public static function query(string $query)
    {
		self::connect();
		return self::$db->query($query);
    }	
	
    public static function execute(string $query, array $params)
    {
		self::connect();
		return self::$db->prepare($query)->execute($params);
    }	
    public static function getColumn(string $query, array $param)
    {
		self::connect();
		return self::$db->prepare($query)->execute($params)->fetchAll(PDO::FETCH_COLUMN);	
    }
	
	public static function queryArr(string $query, array $params = null)
	{
		self::connect();
		
		$tmp = self::$db->prepare($query);
		(!is_null($params)) ? $tmp->execute($params) : $tmp->execute();
		
		return $tmp->fetchAll(PDO::FETCH_ASSOC);
	}	
	
	public static function getRow(string $query, array $params)
    {
		self::connect();
		return self::$db->prepare($query)->execute($params)->fetch(); 
    }
	
	private static function connect() {
		if(!self::$db) {
			$dsn = "mysql:host=".self::$host.";dbname=".self::$base.";charset=".self::$charset;
			self::$db = new PDO($dsn, self::$user, self::$pass, self::$settings);
		}
	}	
}
?>