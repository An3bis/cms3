<?php 	
/**
*	Regular Expressions:
*	{all} - numbers and chars
*	{nums} - only numbers
*	{chars} - only symbols
*
*	Some description:
*	@ - calling method. If doesnt exists, params will be in constructor
**/
return $routes = [
	'GET' => [
		'/' 				=> 'Index',
		'/about/{nums}/' 	=> 'About@aboutCharact'
	]
];