<?php
class Menu extends DB
{
	public function getMenu()
	{
		DB::queryArr('select * from menu');
	}
}