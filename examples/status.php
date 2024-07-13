<?php

require __DIR__."/../autoload.php";

use emagombe\Mpesa;

set_time_limit(0);

$api_key = "";
$public_key = "";
$environment = "development";
$mpesa = Mpesa::init($api_key, $public_key, $environment);

/* Status */
$data = [
	"transaction_id" => "",
	"agent_id" => 171717,
	"third_party_reference" => 33333,
];
$response = $mpesa->status($data);
print_r($response);