<?php

class User {
	
	private $name;
	private $email;
	private $password;
	private $birthdate;

	public function __construct($name, $email, $pass, $bd) {
	 	$this->name = $name;
		$this->email = $email;
		$this->password = $pass;
		$this->birthdate = $bd;		
	}
}
