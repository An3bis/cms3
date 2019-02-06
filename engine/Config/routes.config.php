<?php 	
/***********************************
*
*	Regular Expressions:
*	{all} - numbers and chars
*	{nums} - only numbers
*	{chars} - only symbols
*
*	Some description:
*	name:mask
*	controller@method
*
************************************/
return $routes = [
	'GET' => [
		'/about/{id:nums}/' 	=> 'About@aboutCharact'
	]
];