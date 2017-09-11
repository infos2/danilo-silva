<?php

include_once ("validation/requestValidator.php");
include_once ("exception/requestException.php");

class Request {
	
	private $method;
	private $protocol;
	private $host;
	private $uri;
	private $queryString;
	private $body;
	private $rv;

	public function __construct($method, $protocol, $host, $uri = null, $queryString = null, $body = null) 
	{
		$this->rv = new RequestValidator();
//		var_dump(json_decode($body, true));
		
		$this->setMethod($method);
		$this->protocol = $protocol;
		$this->host = $host;
		$this->setUri($uri);
		$this->queryString = $queryString;
		$this->body = $body;
			
	}

	public function getMethod(){
		return $this->method;
	} 

	public function getPath(){
		return $this->path;
	} 

	public function getBody(){
		return $this->body;
	} 

	public function setMethod($method) {
		if(!$this->rv->isMethodValid($method))
			throw new RequestException("405", "Method not allowed");
		$this->method = $method;
	}	

	public function setUri($uri) {
		if(!$this->rv->isUriValid($uri))
			throw new RequestException("404", "Object not found");

		$this->uri = $uri;
	}

	public function setBody($body) {

    }





















}
