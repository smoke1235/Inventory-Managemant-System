<?php

class Customer {
    
    public $id  = 0;
	public $first_name;
	public $last_name;
	public $company_name;
	public $number;
	public $email;
	public $street;
	public $postcode;
	public $city;
	public $country;


	public function getFullName() {
		return $this->first_name ." ". $this->last_name;
	}

}

