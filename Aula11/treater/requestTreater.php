<?php

require_once ("model/request.php");
require_once ("validation/requestValidator.php");

class RequestTreater {


public function start() {


	try{
	$request = new Request($_SERVER['REQUEST_METHOD'],
						   $_SERVER['SERVER_PROTOCOL'], 
						   $_SERVER['HTTP_HOST'], 
						   $_SERVER['REQUEST_URI'], 
						   $_SERVER['QUERY_STRING'],
						   file_get_contents('php://input'));

	//cenas dos proximos capitulos
	//return (new Router())->sendToContractor($request); 
	
	}catch(RequestException $re) {
		return $re->toJson();
	}

	
	}
}















