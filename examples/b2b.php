<?php

require __DIR__."/../autoload.php";

use emagombe\Mpesa;

set_time_limit(0);

$api_key = "";
$public_key = "";
$ssl = true;
$mpesa = Mpesa::init($api_key, $public_key, $ssl);

/* Transfer from business to business */
$data = [
	"value" => 10,
	"agent_id" => 171717,
	"agent_receiver_id" => 979797,
];
$mpesa->b2b($data, function($response) {
	print_r($response);
});
