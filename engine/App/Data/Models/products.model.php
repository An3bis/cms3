<?php 
namespace Engine\App\Data\Models;

class ProductsModel extends \Engine\Librarys\DB
{
    public function getProducts(): array 
    {
		$products = [];

        foreach($query = $this->getAll('select * from products') as $k => $v)     
			$products[$v['id']] = [
                'name' => $v['name'],
                'price' => $v['price'],
                'mdesc' => $v['mini_desc'],
                'fdesc' => $v['full_desc'],
                'url' => '/store/product-'.$v['id'],
            ];        

        return $products;
    }    

    public function getProduct(string $id): array
    {
        return $this->getAll('select * from products where id = ?i', $id)[0];
    }
}