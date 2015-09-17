<?php
class Config{
	/**
	 * @var array
	 */
	private $config;

	/**
	 * @var Location[]
	 */
	private $locations;

	/**
	 * @var ProductCategory[]
	 */
	private $productCategories;

	/**
	 * @param array $config
	 */
	public function __construct($config){
		$this->config = $config;
		$this->translateConfig();
	}

	private function translateConfig(){
		$this->locations = [];

		if(isset($this->config['locations']))
			foreach($this->config['locations'] as $location)
				$this->locations[] = new Location($location['name'], $location['adress'], $location['zip'], $location['city'], $location['tel'], $location['mail'], $location['location'], $location['visiting_hours']);

		$this->productCategories = [];

		if(isset($this->config['products']))
			foreach($this->config['products'] as $cat => $products) {
				$items = [];

				foreach($products as $product) {
					$extras = [];

					foreach($product['extra'] as $extra)
						$extras[] = new ProductExtra($extra['name'], $extra['price']);

					$items[] = new Product($product['name'], $product['desc'], $product['price'], $product['type'], $product['img'], $extras);
				}

				$this->productCategories[] = new ProductCategory($cat, $items);
			}
	}

	/**
	 * @return Location[]
	 */
	public function getLocations(){
		return $this->locations;
	}

	/**
	 * @return Product[]
	 */
	public function getAllProducts(){
		$return = [];

		foreach($this->productCategories as $productCategory)
			foreach($productCategory->getProducts() as $product)
				$return[] = $product;

		return $return;
	}

	/**
	 * @return ProductCategory[]
	 */
	public function getProductCategories(){
		return $this->productCategories;
	}

	/**
	 * @param string $type
	 *
	 * @return Product[]
	 */
	public function getProductsByType($type){
		$return = [];

		foreach($this->productCategories as $productCategory)
			foreach($productCategory->getProducts() as $product)
				if($product->getType() == $type)
					$return[] = $product;

		return $return;
	}
}