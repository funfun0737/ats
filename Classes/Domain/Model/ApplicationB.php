<?php
namespace PAGEmachine\Ats\Domain\Model;

use SJBR\StaticInfoTables\Domain\Model\Country;

/*
 * This file is part of the PAGEmachine ATS project.
 */


/**
 * Application
 * @codeCoverageIgnore
 */
class ApplicationB extends ApplicationA {


	/**
	 * @var string $title
	 */
	protected $title;

	/**
	 * @return string
	 */
	public function getTitle() {
	  return $this->title;
	}

	/**
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
	  $this->title = $title;
	}


	/**
	 * @var integer $salutation
	 * @validate Integer
	 */
	protected $salutation;

	/**
	 * @return integer
	 */
	public function getSalutation() {
	  return $this->salutation;
	}

	/**
	 * @param integer $salutation
	 * @return void
	 */
	public function setSalutation($salutation) {
	  $this->salutation = $salutation;
	}

	/**
	 * @var string $firstname
	 * @validate NotEmpty
	 */
	protected $firstname;

	/**
	 * @return string
	 */
	public function getFirstname() {
	  return $this->firstname;
	}

	/**
	 * @param string $firstname
	 * @return void
	 */
	public function setFirstname($firstname) {
	  $this->firstname = $firstname;
	}

	/**
	 * @var string $surname
	 * @validate NotEmpty
	 */
	protected $surname;

	/**
	 * @return string
	 */
	public function getSurname() {
	  return $this->surname;
	}

	/**
	 * @param string $surname
	 * @return void
	 */
	public function setSurname($surname) {
	  $this->surname = $surname;
	}


	/**
	 * @var \DateTime $birthday
	 * @validate NotEmpty
	 * @validate DateTime
	 */
	protected $birthday;

	/**
	 * @return \DateTime
	 */
	public function getBirthday() {
	  return $this->birthday;
	}

	/**
	 * @param \DateTime $birthday
	 * @return void
	 */
	public function setBirthday($birthday) {
	  $this->birthday = $birthday;
	}


	/**
	 * @var integer $disability
	 * @validate NumberRange(minimum=1, maximum=2)
	 */
	protected $disability;

	/**
	 * @return integer
	 */
	public function getDisability() {
	  return $this->disability;
	}

	/**
	 * @param integer $disability
	 * @return void
	 */
	public function setDisability($disability) {
	  $this->disability = $disability;
	}

	/**
	 * @var string $nationality
	 */
	protected $nationality;

	/**
	 * @return string
	 */
	public function getNationality() {
	  return $this->nationality;
	}

	/**
	 * @param string $nationality
	 * @return void
	 */
	public function setNationality($nationality) {
	  $this->nationality = $nationality;
	}

	/**
	 * @var string $street
	 * @validate NotEmpty
	 */
	protected $street;

	/**
	 * @return string
	 */
	public function getStreet() {
	  return $this->street;
	}

	/**
	 * @param string $street
	 * @return void
	 */
	public function setStreet($street) {
	  $this->street = $street;
	}


	/**
	 * @var string $zipcode
	 * @validate NotEmpty
	 */
	protected $zipcode;

	/**
	 * @return string
	 */
	public function getZipcode() {
	  return $this->zipcode;
	}

	/**
	 * @param string $zipcode
	 * @return void
	 */
	public function setZipcode($zipcode) {
	  $this->zipcode = $zipcode;
	}


	/**
	 * @var string $city
	 * @validate NotEmpty
	 */
	protected $city;

	/**
	 * @return string
	 */
	public function getCity() {
	  return $this->city;
	}

	/**
	 * @param string $city
	 * @return void
	 */
	public function setCity($city) {
	  $this->city = $city;
	}


	/**
	 * @var SJBR\StaticInfoTables\Domain\Model\Country $country
	 */
	protected $country;

	/**
	 * @return SJBR\StaticInfoTables\Domain\Model\Country
	 */
	public function getCountry() {
	  return $this->country;
	}

	/**
	 * @param SJBR\StaticInfoTables\Domain\Model\Country $country
	 * @return void
	 */
	public function setCountry(Country $country) {
	  $this->country = $country;
	}


	/**
	 * @var string $email
	 * @validate NotEmpty
	 * @validate EmailAddress
	 */
	protected $email;

	/**
	 * @return string
	 */
	public function getEmail() {
	  return $this->email;
	}

	/**
	 * @param string $email
	 * @return void
	 */
	public function setEmail($email) {
	  $this->email = $email;
	}

	/**
	 * @var string $phone
	 */
	protected $phone;

	/**
	 * @return string
	 */
	public function getPhone() {
	  return $this->phone;
	}

	/**
	 * @param string $phone
	 * @return void
	 */
	public function setPhone($phone) {
	  $this->phone = $phone;
	}


	/**
	 * @var string $mobile
	 */
	protected $mobile;

	/**
	 * @return string
	 */
	public function getMobile() {
	  return $this->mobile;
	}

	/**
	 * @param string $mobile
	 * @return void
	 */
	public function setMobile($mobile) {
	  $this->mobile = $mobile;
	}


	/**
	 * @var integer $employed
	 * @validate NumberRange(minimum=1, maximum=2)
	 */
	protected $employed;

	/**
	 * @return integer
	 */
	public function getEmployed() {
	  return $this->employed;
	}

	/**
	 * @param integer $employed
	 * @return void
	 */
	public function setEmployed($employed) {
	  $this->employed = $employed;
	}









}
