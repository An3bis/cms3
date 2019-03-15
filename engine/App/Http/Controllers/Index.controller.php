<?php
namespace Controller;

use Engine\Librarys\View;

class Index extends \Engine\Controller
{
	public function __construct() 
	{
		$view = new View('Main');
		$view->render('Index', [
			'SiteName' => SiteName,
			'About' =>  '/about/',
		]); 
	}
}