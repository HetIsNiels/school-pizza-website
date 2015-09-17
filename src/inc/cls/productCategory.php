<?php
class productCategory {
	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var Product[]
	 */
	private $products;

	/**
	 * @param string $name
	 * @param Product[] $products
	 */
	public function __construct($name, $products){
		$this->name = $name;
		$this->products = $products;
	}

	/**
	 * @return string
	 */
	public function getName(){
		return $this->name;
	}

	/**
	 * @return Product[]
	 */
	public function getProducts()
	{
		return $this->products;
	}
}