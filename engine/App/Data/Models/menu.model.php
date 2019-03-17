<?php 
namespace Engine\App\Data\Models;

class MenuModel extends \Engine\Librarys\DB
{
    public function getMenu(): array 
    {
		$menu = [];
		
		foreach($query = $this->getAll('select * from menu') as $k => $v) 
			$menu[$v['name']] = $v['url'];        

        return $menu;
    }
}