<?php

//TODO: implementar auto incremento de classes  
require_once ("treater/requestTreater.php");


//Externaliza o resultado do processamento da API em formato JSON, sempre.
echo (new RequestTreater())->start();
