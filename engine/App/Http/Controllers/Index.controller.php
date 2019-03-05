<?php
namespace Controller;

use Engine\Librarys\DB;
use Engine\Librarys\View;

class Index 
{
	public function __construct() 
	{
		$view = new View('Main');
		$view->render('Index', [
			'SiteName' => SiteName,
		]); 
	}
}