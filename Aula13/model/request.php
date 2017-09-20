<?php

//include_once ("validation/requestValidator.php");
//include_once ("exception/requestException.php");

class Request {
	
	private $method;
	private $protocol;
	private $host;
	private $uri;
	private $queryString;
	private $body;
	private $resource;
	private $operation;
	private $rv;

	public function __construct($method, $protocol, $host, $uri = null, $queryString = null, $body = null) 
	{
		$this->rv = new RequestValidator();
		
		$this->setMethod($method);
		$this->protocol = $protocol;
		$this->host = $host;
		$this->setUri($uri);
		$this->queryString = $queryString;
		$this->body = $body;
		$this->setResource();
		$this->setOperation();
			
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

	public function getResource() {
		return $this->resource;
	}

	public function getOperation() {
		return $this->operation;
	}

	private function setMethod($method) {
		if(!$this->rv->isMethodValid($method))
			throw new RequestException("405", "Method not allowed");
		$this->method = $method;
	}	

	private function setUri($uri) {
		if(!$this->rv->isUriValid($uri))
			throw new RequestException("404", "Object not found");

		$this->uri = $uri;
	}

	private function setResource() {
		$uri = explode("/", $this->uri);
		$this->resource = $uri[2];
	}

	private function setOperation() {
		$uri = explode("/", $this->uri);
		$this->operation = $uri[3];
	}





















}
