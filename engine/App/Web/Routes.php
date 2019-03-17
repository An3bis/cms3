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
		'/about/' 					=> 'About',
		'/store/product-{id:nums}/' => 'Store@getProduct',		
		'/store/' 					=> 'Store@getProducts',
		'/basket/' 					=> 'Basket@getProducts',
	]
];