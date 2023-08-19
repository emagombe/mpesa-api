<?php

require __DIR__."/../autoload.php";

use emagombe\Mpesa;

set_time_limit(0);

$api_key = "";
$public_key = "";
$ssl = true;
$mpesa = Mpesa::init($api_key, $public_key, $ssl);

/* Transfer to client */
$data = [
	"value" => 10,
	"client_number" => "258840000000",
	"agent_id" => 171717,
	"third_party_reference" => "#MyBusiness-1234",
];
$mpesa->b2c($data, function($response) {
	print_r($response);
});