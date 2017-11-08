<?php

include_once('product_test.php');

echo testGetAllProducts();
$test2 = testInsertValidProduct();
$test3 = testInsertProductWithInvalidName();
echo "<br><br>";
if ($test2 == true) 
	echo "Teste Inserir produto valido passou";
else 
	echo "Teste Inserir produto valido não passou";

echo "<br><br>";
if ($test3 == true) 
	echo "Teste Inserir produto invalido passou";
else 
	echo "Teste Inserir produto invalido não passou";

