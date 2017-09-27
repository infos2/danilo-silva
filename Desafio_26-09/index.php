<?php

//TODO: implementar auto requirimento de classes  
require_once ("autoload.php");

//Externaliza o resultado do processamento da API em formato JSON, sempre.
//echo (new DateTime)->getTimestamp();
//echo date('m/d/Y H:i:s', (new DateTime)->getTimestamp());


var_dump((new RequestTreater())->start());
