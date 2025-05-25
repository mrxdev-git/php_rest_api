<?php

namespace DataEx\Model;

class ProductsModel extends Model
{
	protected $table = 'shop_product';

	public function getProducts($offset, $limit)
	{
		return $this->getAll(
			   'id, name, status, price, url, description',
			   'id ASC',
			   $offset,
			   $limit
		);
	}

	public function getProductFeatures($product_id)
	{
		$sql = "SELECT sf.`id`, sf.`type`, sf.`name`, sf.`code`
				  FROM `shop_feature` AS sf
         			JOIN `shop_product_features` AS spf
         				ON sf.`id` = spf.`feature_id`
                  WHERE spf.`product_id` = :product_id";

		$features = $this->query($sql, [
			   'i:product_id' => $product_id
		]);

		$result = [];

		if ($features){
			foreach ($features as $feature){
				$values = $this->getProductValues(
					   $product_id,
					   $feature['id'],
					   $feature['type']
				);

				if ($values) {
					$result[$feature['code']] = array_map(
						   function($value) {
							   return $value['value'];
						   }, $values
					);
				}
			}
		}

		return $result;
	}

	public function getProductValues($product_id, $feature_id, $feature_type)
	{
		try {
			$table_name = $this->resolveTableName($feature_type);

			$sql = "SELECT vtable.`value`
				FROM `{$table_name}` AS vtable
					JOIN `shop_product_features` AS spf
						ON vtable.id = spf.feature_value_id
				WHERE vtable.`feature_id` = :feature_id
					AND spf.`product_id` = :product_id";

			return $this->query(
				   $sql, [
				   'i:feature_id' => $feature_id,
				   'i:product_id' => $product_id
			]
			);
		} catch (\PDOException $e) {
			return [];
		}
	}

	public function getProductCategoryIds($product_id): array
	{
		$ids = $this->query(
			   "SELECT `category_id` 
						FROM `shop_category_products`
						WHERE `product_id` = :product_id",
			   [
					  'i:product_id' => $product_id
			   ]
		);

		if ($ids){
			return array_map(function($item){
				return $item['category_id'];
			}, $ids);
		}

		return [];
	}

	public function getProductImages($product_id)
	{
		return $this->query(
			   "SELECT `id`, `ext` 
				FROM `shop_product_images` 
				WHERE `product_id` = :product_id",
			   [
					  'i:product_id' => $product_id
			   ]
		);
	}

	private function resolveTableName($feature_type): string
	{
		$feature_type_parts = explode('.', $feature_type);
		return 'shop_feature_values_' .
		              (count($feature_type_parts) === 3
			                 ? $feature_type_parts[1]
			                 : $feature_type_parts[0]);
	}
}