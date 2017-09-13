<?php

define('WWW_ROOT', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);

function __autoload($class) {
    $class = WWW_ROOT . DS . str_replace('\\' , DS , $class) . '.php';
echo $class;
    if(!file_exists($class)) {
        throw new Exception("File path '{$class}' not found.");
    }

    require_once($class);
}