<?php
namespace Controller;

use Engine\Librarys\View;
use Engine\Librarys\DB;

class Index extends \Engine\Controller
{
	public function __construct() 
	{
		$db = new DB;
		$menu = [];
		
		foreach($query = $db->getAll('select * from menu') as $k => $v) 
			$menu[$v['name']] = $v['url'];

		$view = new View('Main');
		$view->render('Index', [
			'sitename' => SiteName,
			'menu' =>  $menu,
		]); 			
	}
}