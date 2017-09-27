<?php

//include_once "IrequestValidator.php";

class RequestValidator implements IRequestValidator 
{
	private $allowedMethods = Array('GET', 'PUT', 'POST');

	private $allowedUris = 
			Array('users' => Array('info', 'register'),
				  'groups' => Array('create', 'members', 'info'),
				  'posts' => Array('register', 'info'));

	private $requiredBodys =
        Array(
            'users' => Array('name', 'email', 'pass', 'bdate'),
            'posts' => Array('title', 'username', 'text')
        );

	private $allowedOperations = Array(
	  'POST' => Array('register'),
	  'PUT' => Array('register', 'update', 'delete'),
	  'GET' => Array('info', 'members')
    );

	public function isUriValid($uri) {
		$arrayUri = explode('/', $uri);

		//verificar se arrayUri[2] é chave
		if(!in_array($arrayUri[2], $this->allowedUris[$arrayUri[1]]))
			return false;
		
		return true;
	}

    public function isOperationValid($operation, $method) {
	    if (!in_array($operation, $this->allowedOperations[$method]))
	        return false;

	    return true;
    }

	public function isMethodValid($method) {

		if(!in_array($method, $this->allowedMethods)) 
			return false;

		return true;		
	}

	public function isProtocolValid($protocol) {
		if($protocol != "HTTP/1.1")
		    return false;

		return true;
	}

	

	public function isQueryStringValid($qs) {
        if (isset($qs[0]) && $qs[0] != "") {
            if (isset($qs[1]) && $qs[1] != "")
                return true;
        }

        return false;
	}

	public function isBodyValid($body, $method, $resource) {
		if($method == "POST" || $method == "PUT") {
		    foreach ($this->requiredBodys[$resource] as $value){
		        if (!isset($body[$value]))
		            return false;
            }
            if ($method == "PUT" && !isset($body["_id"]))
                return false;
        }

        return true;
	}
}