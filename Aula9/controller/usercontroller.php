<?php

require_once ("../model/user.php");

class UserController {
	
	
	public function create($name, $email, $pass, $bd) {
		var_dump(new User($name, $email, $pass, $bd));		
		//$conn = $db->getConnection();
		//$conn->insert(new User($name, $email, $pass, $bd));	
	}

}
