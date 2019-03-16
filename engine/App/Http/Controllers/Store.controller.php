<?php
namespace Controller;

use Engine\App\Data\Models\ProductsModel;
use Engine\Librarys\View;

class Store extends \Engine\Controller
{
	private $productsModel;
	private $view;

	public function __construct() 
	{
		$this->productsModel = new ProductsModel();
		$this->view = new View('Main');
	}

	public function getProducts() 
	{
		$this->view->render('Store', [
			'products' => $this->productsModel->getProducts(),
		]);
	}

	public function getProduct(?array $params) 
	{
		$product = $this->productsModel->getProduct($params['id']);

		$this->view->render('Product', [
			'product_name' => $product['name'],
			'product_price' => $product['price'],
		]);	
	}
}