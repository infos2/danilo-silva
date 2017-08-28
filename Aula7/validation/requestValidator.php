<?php

include_once "IrequestValidator.php";

class RequestValidator implements IRequestValidator {

    private $resources = Array('product', 'provider', 'employee', 'user', 'function',
        'section', 'sale', 'purchase', 'bonus', 'expense', 'productLost', 'Aula7', '');

    public function __construct() {
        $this->prepareResources();
    }

    public function isMethodValid($method) {

        if (!in_array($method, $this->resources['methods']))
            return false;
        return true;
    }

    public function isProtocolValid($protocol) {
        if ($protocol != "HTTP/1.1") {
            return false;
        }
        return true;
    }

    public function isUriValid($uri, $method) {
        if (!in_array($uri, $this->resources['uris'][$method]))
            return false;
        return true;
    }

    public function isQueryStringValid($queryString) {
        foreach ($queryString as $value) {
            if (!in_array($value, $this->resources['queryStrings']))
                return false;
        }
        return true;
    }

    public function isBodyValid($body, $uri) {
        foreach ($this->resources['bodys'][$uri] as $value) {
            if (!isset($body->$value))
                return false;
        }
        return true;
    }

    public function prepareResources() {
        $this->resources['methods'] = Array('POST', 'PUT', 'GET');

        $this->resources['uris']['POST'] = Array('/product', '/provider', '/employee', '/user', '/function',
            '/section', '/sale', '/purchase', '/bonus', '/expense', '/productLost');
        $this->resources['uris']['PUT'] = Array('/product', '/provider', '/employee', '/user', '/function',
            '/section', '/sale', '/purchase', '/bonus', '/expense', '/productLost', '/product/disable', '/provider/disable', '/employee/disable', 'user/disable', 'function/disable',
            'section/disable', 'sale/disable', 'purchase/disable', 'bonus/disable', 'expense/disable', 'productLost/disable');
        $this->resources['uris']['GET'] = Array('/product', '/provider', '/employee', '/user', '/function',
            '/section', '/sale', '/purchase', '/bonus', '/expense', '/productLost');

        $this->resources['queryStrings'] = Array('productId', 'providerId', 'employeeId', 'userId', 'functionId',
            'sectionId', 'saleId', 'purchaseId', 'bonusId', 'expenseId', 'productLostId');

//        $this->resources['bodys']['POST']['user'] = Array('name', 'email', 'password', 'birthdate');
        $this->resources['bodys']['/user'] = Array('name', 'email', 'password', 'birthdate');
//        $this->resources['bodys']['POST']['product'] = Array('name', 'description', 'purchasePrice', 'salePrice', 'sectionId', 'providerId', 'stock');
        $this->resources['bodys']['/product'] = Array('productId', 'name', 'description', 'purchasePrice', 'salePrice', 'sectionId', 'providerId', 'stock');
    }

}
