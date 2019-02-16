<?php 
namespace Controller;

class About 
{
	public function __construct() 
	{
		echo "About -> __construct() <br />";
	}

	public function aboutCharact(array $matches) 
	{
		echo 'Controller -> About -> aboutCharact() <br />';
		var_dump($matches);
	}
}