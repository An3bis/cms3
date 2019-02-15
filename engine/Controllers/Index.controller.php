<?php
namespace Controller;

use Engine\DB;
use Engine\Models\Menu;

class Index // add extends
{
	public function __construct() 
	{
		echo 'Controller -> Index -> Construct() <br />';
		//var_dump( Menu::getMenu() );
	}
}