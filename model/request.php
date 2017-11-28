<?php

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
    private $arrayOperations = Array('POST/' => 'register', 'PUT/' => 'update', 'PUT/delete' => 'delete', 'GET/' => 'search');

    public function __construct($method, $protocol, $host, $uri = null, $queryString = null, $body = null) {
        //Cria uma instância da classe requestValidador e joga na variável $rv
        $this->rv = new RequestValidator();

        //Tenta setar os atributos da request, por meio dos métodos 'set', que fazem as validações de cada atributo. Caso encontre algum erro, lança uma excessão e encerra o programa
        $this->setMethod($method);
        $this->setProtocol($protocol);
        $this->setHost($host);
        $this->setUri($uri);
        $this->setResource();
        $this->setOperation();
        $this->setQueryString($queryString);
        $this->setBody($body);
    }

    public function getMethod() {
        return $this->method;
    }

    public function getBody() {
        return $this->body;
    }

    public function getResource() {
        return $this->resource;
    }

    public function getOperation() {
        return $this->operation;
    }

    public function getQueryString() {
        return $this->queryString;
    }

    private function setMethod($method) {
        //Se o método não for válido, lança uma excessão. Se for válido, é atribuído à variável $method.
        if (!$this->rv->isMethodValid($method))
            throw new RequestException("405", "Method not allowed");

        $this->method = $method;
    }

    private function setProtocol($protocol) {
        //Se o protocolo não for válido, lança uma excessão. Se for válido, é atribuído à classe.
        if (!$this->rv->isProtocolValid($protocol))
            throw new RequestException("505", "HTTP Version Not Supported");

        $this->protocol = $protocol;
    }

    private function setHost($host) {
        //O host não precisa de validação. Se chegou ao servidor, é porque está certo.
        $this->host = $host;
    }

    private function setUri($uri) {
        $cleanUri = explode('?', $uri); //Quebra a uri na '?' para separar da query string
        $arrayUri = explode('/', $cleanUri[0]); //Depois, quebra a uri na '/' para separar cada parte e joga na variável $arrayUri
        //Apenas para ajustar as posições do array caso os arquivos não estejam na raiz da pasta html ou htdocs. 
        //Essa parte não é necessária para o projeto
        if ($arrayUri[1] == "ProjetoDW") {
            unset($arrayUri[1]);
            $arrayUri = array_values($arrayUri);
        }

        if (!$this->rv->isUriValid($arrayUri, $this->method))
            throw new RequestException("400", "Invalid URI");

        $this->uri = $arrayUri;
    }

    private function setQueryString($queryString) {
        $finalQueryString = Array();
        if (strlen($queryString) > 0) {
            $queryArray = explode('&', $queryString);

            foreach ($queryArray as $value) {
                $a = explode('=', $value);
                if (!$this->rv->isQueryStringValid($a))
                    throw new RequestException("400", "Bad request");

                $finalQueryString[$a[0]] = $a[1];
            }
        }
        $this->queryString = $this->treatQueryString($finalQueryString); //$finalQueryString;
    }

    private function setBody($body) {
        $bodyArray = json_decode($body, true);
        if (!$this->rv->isBodyValid($this->resource, $this->operation, $bodyArray))
            throw new RequestException("400", "Invalid body request");

        if (isset($bodyArray['_id']))
            $bodyArray['_id'] = $this->treatId($bodyArray['_id']);

        $this->body = $bodyArray;
    }

    private function setResource() {
//        $uri = $this->uri;
        $this->resource = $this->uri[1];
    }

    private function setOperation() {
        //Se veio alguma operação, joga na variável $uriOperation. Se não, deixa vazia
        $uriOperation = (!isset($this->uri[2])) ? "" : $this->uri[2];

        if ($this->resource == 'login' || $this->resource == 'logout' || $this->resource == 'test')
            $this->operation = $this->resource;
        else
        //A operação vai ser igual a o que estiver na $arraOperations na posição da junção do $method + / + $uriOperation
            $this->operation = $this->arrayOperations[$this->method . '/' . $uriOperation];
    }

    private function treatQueryString($qs) {
        $newQs = Array();
        if (isset($qs['_id'])) {
            $newQs['_id'] = $this->treatId($qs['_id']);
            unset($qs['_id']);
        }

        foreach ($qs as $key => $value) {
            if (!is_numeric($value))
                $newQs[$key] = new MongoDB\BSON\Regex('.*' . $value . '.*', '');
            else
                $newQs[$key] = (float) $value;
        }

        return $newQs;
    }

    private function treatId($id) {
        if (preg_match('/^[a-f\d]{24}$/i', $id))
            return new MongoDB\BSON\ObjectId($id);

        return $id;
    }

}
