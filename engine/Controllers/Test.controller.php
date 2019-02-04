<?php 
namespace Controller;

class Test 
{
	public function __construct()
	{
		echo 'Controller -> Test -> __construct() <br/>';
	}

	public function testCnt(array $matches) 
	{
		echo 'Controller -> Test -> testCnt()';
		var_dump($matches);
	}
}