<?php 	
/***********************************
*
*	Named masks:
*	{all} - numbers and chars
*	{nums} - only numbers
*	{chars} - only symbols
*
*	Some description:
*	{name:mask}
*	controller@method
*
************************************/
return $routes = [
	'GET' => [
		//'/' => 'Index',
		'/about/' => 'About',
		'/about/{id:nums}/' => 'About@test',	
	]
];