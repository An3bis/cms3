<?php
namespace Engine\Models;

use Engine\Model;

class Menu
{
	public static function getMenu()
	{
		var_dump( Model::queryArr('select * from menu') );
	}
}