<?php

require_once "../model/request.php";
require_once "./Validator.php";

$request = new Request($_SERVER['REQUEST_METHOD'],$_SERVER['SERVER_PROTOCOL'], $_SERVER['HTTP_HOST']);

$validator = new Validator();

if(!$validator->validMethod($request->getMethod())){
    $response['code'] = 405;
    $response['message'] = 'Metodo invalido.';
    return json_encode($response);
}

if(!$validator->validProtocol($request->getProtocol())){
    $response['code'] = 403;
    $response['message'] = 'Protocolo nao permitido.';
    return json_encode($response);
}







