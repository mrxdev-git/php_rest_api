<?php

namespace DataEx\Controller;

use DataEx\Model\FeaturesModel;

class FeaturesController extends Controller
{

	public function process(): array
	{

		$offset = $_GET['offset'] ?? 0;
		$limit = $_GET['limit'] ?? 100;

		$model = new FeaturesModel();

		return $model->getFeatures($offset,$limit);
	}

}