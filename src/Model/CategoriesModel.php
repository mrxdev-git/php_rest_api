<?php

namespace DataEx\Model;

class CategoriesModel extends Model
{
	protected $table = 'shop_category';

	public function getCategories()
	{
		return $this->getAll(
			   'id,name,parent_id, filters, status, url',
			   'parent_id ASC',
			   false
		);
	}

}