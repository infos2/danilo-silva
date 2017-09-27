<?php

//require_once ("model/user.php");
//require_once ("database/database.php");
// ("exception/requestException.php");

class PostController {

	private $allowedOperations = Array('info', 'register');
	private $request;
	
	public function __construct($request) {
		$this->request = $request;
	}			  

	public function routeOperation() {
		//$body = json_decode($this->request->getBody(),true);
		switch($this->request->getOperation()) {
			case 'register':
					return $this->create($this->request->getBody(), $this->request->getResource());
			case 'info':
					if($this->request->getMethod() == "GET")
						return $this->search($this->request->getQueryString(), $this->request->getResource());
			//default:		
					return (new RequestException(400, "Bad request"))->toJson();
		}
	}
	
	
	private function create($body) { 	
		try{ 	
		 	$post = new Post($body["title"], $body["username"], $body["text"]);
		 	$body["timestamp"] = $post->getTimestamp();
		 	return (new DBHandler())->insert($body, 'posts');
            //return 'register ok';
		 }catch(RequestException $ue) {
		 	 return $ue->toJson();
		 }	
	}

	private function search($queryString) {
		return (new DBHandler())->search($queryString, 'posts');
	}

}
