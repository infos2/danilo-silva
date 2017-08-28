<?php

require_once ("model/request.php");
require_once ("validation/requestValidator.php");

class RequestTreater {

    public function start() {


//        $valid = (new RequestValidator)->isMethodValid($_SERVER['REQUEST_METHOD']);

        parse_str($_SERVER['QUERY_STRING'], $queryString);
        $entityBody = file_get_contents('php://input');
        $requestUri = explode('/', explode('?', $_SERVER['REQUEST_URI'])[0]);

        $request = new Request($_SERVER['REQUEST_METHOD'], $_SERVER['SERVER_PROTOCOL'], $_SERVER['HTTP_HOST'], $requestUri, $queryString, json_decode($entityBody));

        var_dump($request);
        return $this->validateRequest($request);
//        var_dump($request);
//
//        if ($request->getMethod() == 'POST' && $request->getPath()[2] == 'user') {
//
//            return $valid;
//        }
    }

    public function validateRequest($request) {
        $valid = new RequestValidator();

        $uri = '';
//        foreach ($request->getPath() as $value) {
//            $uri = $uri . '/' . $value;
//        }
//        var_dump(count($request->getPath()));
       
        for ($i = 2; $i < count($request->getPath()); $i++){
            $uri = $uri . '/' . $request->getPath()[$i];
        }

        if (!($valid->isMethodValid($request->getMethod()) && $valid->isProtocolValid($request->getProtocol()) && $valid->isUriValid($uri, $request->getMethod())))
            return false;

        if ($request->getMethod() == "GET")
            return $valid->isQueryStringValid($request->getQueryString());

        return $valid->isBodyValid($request->getBody(), $uri);
    }

}
