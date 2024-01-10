<?php

namespace DataEx\Controller;

use DataEx\Model\CategoriesModel;

class CategoriesController extends Controller
{

	public function process(): array
	{
		$model = new CategoriesModel();
		$cats = $model->getCategories();

		return $cats;
	}

}