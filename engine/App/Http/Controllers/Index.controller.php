<?php
namespace Controller;

use Engine\Librarys\DB;

class Index 
{
	public function __construct() 
	{
		//var_dump( DB::query('select * from genre') );
		var_dump( DB::queryArr('select * from ?', ['genre']) );
	}
}