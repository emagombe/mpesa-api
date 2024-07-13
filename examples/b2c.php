<?php

require __DIR__."/../autoload.php";

use emagombe\Mpesa;

set_time_limit(0);

$api_key = "";
$public_key = "";
$environment = "development";
$mpesa = Mpesa::init($api_key, $public_key, $environment);

/* Transfer to client */
$data = [
	"value" => 10,
	"client_number" => "258840000000",
	"agent_id" => 171717,
	"third_party_reference" => 33333,
	"transaction_reference" => 1234567,
];
$response = $mpesa->b2c($data);
print_r($response);