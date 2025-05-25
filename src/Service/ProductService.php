<?php

namespace DataEx\Service;

use DataEx\Model\ProductsModel;

class ProductService
{
	protected static $images_path = 'modules/shop/products/img/';
	protected static $site_url = 'https://electrotorg.biz.ua/';

	/**
	 * @var ProductsModel
	 */
	protected $products_model;

	public function __construct()
	{
		$this->products_model = new ProductsModel();
	}

	public function getProducts($offset, $limit)
	{
		$products = $this->products_model->getProducts(
			   $offset,
			   $limit
		);

		if ($products){
			foreach ($products as &$product){
				$product['features'] = $this->products_model->getProductFeatures(
					   $product['id']
				);

				$product['category_ids'] = $this->products_model->getProductCategoryIds(
					   $product['id']
				);

				$product['images'] = $this->getImages(
					   $product['id']
				);
			}
		}

		return $products;
	}

	protected function getImages($product_id)
	{
		$images = $this
			   ->products_model
			   ->getProductImages($product_id);

		$result = [];
		foreach ($images as $row) {
			$str = str_pad(
				   $product_id,
				   4,
				   '0',
				   STR_PAD_LEFT
			);

			$result[] = self::$site_url
			            . self::$images_path
			            . substr($str, -2)
			            . "/"
			            . substr($str, -4, 2)
			            . "/"
			            . $product_id
			            . "/images/"
			            . $row['id']
			            . "/"
			            . $row['id']
			            . '.750x0.'
			            . $row['ext'];
		}

		return $result;
	}
}