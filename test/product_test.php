<?php

include_once ("httpful.phar");


function testGetAllProducts() {

	$response = \Httpful\Request::get('http://172.22.51.160/products')->send();

	echo $response;
}

function testInsertProductWithInvalidName() {

	$uri = 'http://172.22.51.160/products';
	$response = \Httpful\Request::post($uri)
	->sendsJson()
	->body('{
	"name" : "",
	"description" : "Cebola roxa do Himalaia",
	"purchaseprice" : "2.0",
	"saleprice" : "3.0",
	"measure" : "Quilo",
	"section" : {
		"name" : "Hortifruti",
		"description" : "Seção de frutas, verduras e legumes"
	},
	"provider" : {
		"name": "Cebolas Inc", 
		"cnpj" : "28.338.875/0001-17", 
		"phones" : ["(61)99876-3272"], 
		"email" : "cebolas@mail.com", 
		"description" : "Fornecedor de cebolas"
	},
	"currentstock" : 10}')->send();

	return strcmp($response->body, '{"code":"400","message":"Bad request"}' ) == 0;
	//return $response->body;


}

function testInsertValidProduct() {

	$uri = 'http://172.22.51.160/products';
	$response = \Httpful\Request::post($uri)
	->sendsJson()
	->body('{
	"name" : "Tomate",
	"description" : "Batata Inglesa do Himalaia",
	"purchaseprice" : "2.0",
	"saleprice" : "3.0",
	"measure" : "Quilo",
	"section" : {
		"name" : "Hortifruti",
		"description" : "Seção de frutas, verduras e legumes"
	},
	"provider" : {
		"name": "Batata  Inc", 
		"cnpj" : "28.338.875/0001-17", 
		"phones" : ["(61)99876-3272"], 
		"email" : "cebolas@mail.com", 
		"description" : "Fornecedor de cebolas"
	},
	"currentstock" : 10}')->send();

	return strcmp($response->body, '{"code":"200","message":"Ok"}') == 0;
	//return $response->body;


}