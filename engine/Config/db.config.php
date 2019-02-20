<?php 
return $dbconfig = [
	'db_host'	=> 'localhost',
	'db_user' 	=> 'wembley',
	'db_pass' 	=> 'wembley0372',
	'db_base' 	=> 'store',
	'db_params' => [
		PDO::ATTR_ERRMODE 				=> PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE 	=> PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES 		=> false
	]
];