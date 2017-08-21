<?php

require_once ("model/request.php");
require_once ("controller/userController.php");

class RequestTreater {


public function start() {

	$request = new Request($_SERVER['REQUEST_METHOD'], $_SERVER['SERVER_PROTOCOL'], $_SERVER['HTTP_HOST'], explode('/', $_SERVER['REQUEST_URI']), $_SERVER['QUERY_STRING'],
        json_decode(file_get_contents('php://input')));


	if($request->getMethod() != 'GET' && $request->getMethod() != 'POST' && $request->getMethod() != 'PUT') {
		
		return json_encode(array('code' => 405, 'message' => 'method not allowed'));

}
//var_dump($request->getBody());
	if($request->getMethod() == 'POST' && $request->getPath()[2] == 'user') {
 		//return "cheguei!";
		(new UserController())->create($request->getBody()->name, $request->getBody()->email, $request->getBody()->password, $request->getBody()->birthdate);
	}
}
}















