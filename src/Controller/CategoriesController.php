<?php

namespace DataEx\Controller;

use DataEx\Model\CategoriesModel;

class CategoriesController extends Controller
{

	public function process(): array
	{
		$offset = $_GET['offset'] ?? 0;
		$limit  = $_GET['limit'] ?? 100;

		$model = new CategoriesModel();
		return $model->getAll($offset, $limit);
	}

}