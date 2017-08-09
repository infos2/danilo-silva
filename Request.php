<?php

class Request
{
    private $method;
    private $protocol;
    private $host;
    private $path;
    private $query_string;
    
    function __construct($method, $protocol, $host, $path, $query_string)
    {
        $this->method = $method;
        $this->protocol = $protocol;
        $this->host = $host;
        $this->path = $path;
        $this->query_string = $query_string;
        }

   
    public function getMethod()
    {
        return $this->method;
    }

    
    public function setMethod($method)
    {
        $this->method = $method;
    }

    
    public function getProtocol()
    {
        return $this->protocol;
    }

    
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;
    }

    
    public function getHost()
    {
        return $this->host;
    }

    
    public function setHost($host)
    {
        $this->host = $host;
    }

    
    public function getPath()
    {
        return $this->path;
    }

    
    public function setPath($path)
    {
        $this->path = $path;
    }

    
    public function getQueryString()
    {
        return $this->query_string;
    }

    
    public function setQueryString($query_string)
    {
        $this->query_string = $query_string;
    } 
}