<?php

class Validator {

    public function validMethod($method) {
        if ($method == "GET" || $method == "POST" || $method == "PUT" || $method == "DELETE") {
            return true;
        } else {
            return false;
        }
    }

    public function validProtocol($protocol) {
        if($protocol == "HTTP" || $protocol == "HTTPS") {
            return true;
        } else {
            return false;
        }
    }
}
