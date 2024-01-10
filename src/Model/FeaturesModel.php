<?php

namespace DataEx\Model;

class FeaturesModel extends Model {

	protected $table = 'shop_feature';

	public function getFeatures($offset, $limit)
	{
		return $this->getAll(
			   '*',
			   'id ASC',
			   $offset,
			   $limit
		);
	}
}