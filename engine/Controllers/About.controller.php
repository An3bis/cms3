<?php 
namespace Controller;

class About 
{
	public function aboutCharact(array $matches) 
	{
		echo 'Controller -> About -> aboutCharact() <br />';
		print_r('Number - '.$matches[0]);
	}
}