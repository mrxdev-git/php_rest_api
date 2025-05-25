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

	public function getFeaturesInUse($offset, $limit)
	{
		return $this->query("SELECT sf.*
			FROM `{$this->table}` AS sf
            WHERE sf.`id` IN
            	(SELECT DISTINCT `feature_id` FROM `shop_product_features`)
            LIMIT :offset, :limit", [
				   'i:offset' => $offset,
				   'i:limit' => $limit
		]);
	}
}