<?php
/**
 * Class Location
 */
class Location{
	/**
	 * @var string
	 */
	private $name;
	/**
	 * @var string
	 */
	private $adress;
	/**
	 * @var string
	 */
	private $zip;
	/**
	 * @var string
	 */
	private $city;
	/**
	 * @var string
	 */
	private $tel;
	/**
	 * @var string
	 */
	private $mail;

	/**
	 * @var string
	 */
	private $location;

	/**
	 * @var int[]
	 */
	private $visitingHours;

	/**
	 * @param string $name
	 * @param string $adress
	 * @param string $zip
	 * @param string $city
	 * @param string $tel
	 * @param string $mail
	 * @param string $location
	 * @param int[] $visitingHours
	 */
	public function __construct($name, $adress, $zip, $city, $tel, $mail, $location, $visitingHours){
		$this->name = $name;
		$this->adress = $adress;
		$this->zip = $zip;
		$this->city = $city;
		$this->tel = $tel;
		$this->mail = $mail;
		$this->location = $location;
		$this->visitingHours = $visitingHours;
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
	public function getAdress()
	{
		return $this->adress;
	}

	/**
	 * @return string
	 */
	public function getZip()
	{
		return $this->zip;
	}

	/**
	 * @return string
	 */
	public function getCity()
	{
		return $this->city;
	}

	/**
	 * @return string
	 */
	public function getTel()
	{
		return $this->tel;
	}

	/**
	 * @return string
	 */
	public function getMail()
	{
		return $this->mail;
	}

	/**
	 * @return string
	 */
	public function getLocation(){
		return $this->location;
	}

	/**
	 * @return int[]
	 */
	public function getVisitingHours()
	{
		return $this->visitingHours;
	}
}