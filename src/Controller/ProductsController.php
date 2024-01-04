<?php

namespace DataEx\Controller;

use DataEx\Model\ProductsModel;

class ProductsController extends Controller
{
	public function process(): array
	{
		$offset = $_GET['offset'] ?? 0;
		$limit  = $_GET['limit'] ?? 100;

		$model = new ProductsModel();
		return $model->getAll('*', 'id ASC', $offset, $limit);
	}
}