<?php
class Product{
	/**
	 * @var string
	 */
	private $name;
	/**
	 * @var string
	 */
	private $desc;
	/**
	 * @var float
	 */
	private $price;
	/**
	 * @var string
	 */
	private $type;
	/**
	 * @var string
	 */
	private $img;
	/**
	 * @var ProductExtra[]
	 */
	private $extra;

	/**
	 * @param string $name
	 * @param string $desc
	 * @param float $price
	 * @param string $type
	 * @param string $img
	 * @param ProductExtra[] $extra
	 */
	public function __construct($name, $desc, $price, $type, $img, $extra){
		$this->name = $name;
		$this->desc = $desc;
		$this->price = $price;
		$this->type = $type;
		$this->img = $img;
		$this->extra = $extra;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getDesc()
	{
		return $this->desc;
	}

	/**
	 * @return float
	 */
	public function getPrice()
	{
		return $this->price;
	}

	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * @return string
	 */
	public function getImg()
	{
		return $this->img;
	}

	/**
	 * @return ProductExtra[]
	 */
	public function getExtra()
	{
		return $this->extra;
	}
}