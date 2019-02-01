<?php
namespace Engine\Models;

class Menu extends Model
{
	public static function getMenu()
	{
		Model::queryArr('select * from menu');
	}
}