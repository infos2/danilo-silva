<?php

// Importação do autoload do composer
require_once __DIR__.'/vendor/autoload.php';

// Conexão ao banco de dados, porta padrão 27017
$client = new MongoDB\Client();