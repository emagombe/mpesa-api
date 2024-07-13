<?php

require __DIR__."/../autoload.php";

use emagombe\Mpesa;

set_time_limit(0);

$api_key = "";
$public_key = "";
$environment = "development";
$mpesa = Mpesa::init($api_key, $public_key, $environment);

/* Transfer from business to business */
$data = [
	"value" => 10,
	"agent_id" => 171717,
	"agent_receiver_id" => 979797,
	"third_party_reference" => 33333,
	"transaction_reference" => 1234567,
];
$response = $mpesa->b2b($data);
print_r($response);