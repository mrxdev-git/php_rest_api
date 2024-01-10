<?php

namespace DataEx\Model;

class FeaturesModel extends Model {

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