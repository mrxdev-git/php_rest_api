<?php

namespace DataEx\Model;

class CategoriesModel extends Model
{
	protected $table = 'shop_category';

	public function getCategories()
	{
		return $this->getAll(
			   'id, name, parent_id, filter, status, url, full_url, description, summary',
			   'parent_id ASC',
			   false
		);
	}

}