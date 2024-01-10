<?php

namespace DataEx\Controller;

use DataEx\Model\ProductsModel;
use DataEx\Service\ProductService;

class ProductsController extends Controller
{
	public function process(): array
	{
		$offset = $_GET['offset'] ?? 0;
		$limit  = $_GET['limit'] ?? 100;

		$product_service = new ProductService();

		return $product_service->getProducts($offset, $limit);
	}
}