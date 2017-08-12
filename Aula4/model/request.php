<?php

class Request {

    private $method;
    private $protocol;
    private $host;
    private $path;
    private $queryString;
    private $body;

    public function __construct($method, $protocol, $host, $path = null, $queryString = null, $body = null) {
        $this->method = $method;
        $this->protocol = $protocol;
        $this->host = $host;
        $this->path = $path;
        $this->queryString = $queryString;
        $this->body = $body;
    }

    function getMethod() {
        return $this->method;
    }

    function getProtocol() {
        return $this->protocol;
    }

    function getHost() {
        return $this->host;
    }

    function getPath() {
        return $this->path;
    }

    function getQueryString() {
        return $this->queryString;
    }

    function getBody() {
        return $this->body;
    }

    function setMethod($method) {
        $this->method = $method;
    }

    function setProtocol($protocol) {
        $this->protocol = $protocol;
    }

    function setHost($host) {
        $this->host = $host;
    }

    function setPath($path) {
        $this->path = $path;
    }

    function setQueryString($queryString) {
        $this->queryString = $queryString;
    }

    function setBody($body) {
        $this->body = $body;
    }

}
