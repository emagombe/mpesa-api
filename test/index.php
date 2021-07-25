<?php

require __DIR__."/../autoload.php";

use emagombe\Mpesa;

set_time_limit(0);

$api_key = "v5l0btxntcuh7pxq0mltilxj15hj6e9r";
$public_key = "MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAmptSWqV7cGUUJJhUBxsMLonux24u+FoTlrb+4Kgc6092JIszmI1QUoMohaDDXSVueXx6IXwYGsjjWY32HGXj1iQhkALXfObJ4DqXn5h6E8y5/xQYNAyd5bpN5Z8r892B6toGzZQVB7qtebH4apDjmvTi5FGZVjVYxalyyQkj4uQbbRQjgCkubSi45Xl4CGtLqZztsKssWz3mcKncgTnq3DHGYYEYiKq0xIj100LGbnvNz20Sgqmw/cH+Bua4GJsWYLEqf/h/yiMgiBbxFxsnwZl0im5vXDlwKPw+QnO2fscDhxZFAwV06bgG0oEoWm9FnjMsfvwm0rUNYFlZ+TOtCEhmhtFp+Tsx9jPCuOd5h2emGdSKD8A6jtwhNa7oQ8RtLEEqwAn44orENa1ibOkxMiiiFpmmJkwgZPOG/zMCjXIrrhDWTDUOZaPx/lEQoInJoE2i43VN/HTGCCw8dKQAwg0jsEXau5ixD0GUothqvuX3B9taoeoFAIvUPEq35YulprMM7ThdKodSHvhnwKG82dCsodRwY428kg2xM/UjiTENog4B6zzZfPhMxFlOSFX4MnrqkAS+8Jamhy1GgoHkEMrsT5+/ofjCx0HjKbT5NuA2V/lmzgJLl3jIERadLzuTYnKGWxVJcGLkWXlEPYLbiaKzbJb2sYxt+Kt5OxQqC1MCAwEAAQ==";
$ssl = true;
$mpesa = Mpesa::init($api_key, $public_key, $ssl);

/* Transfer to client */
$data = [
	"value" => 10,
	"client_number" => "258850375093",
	"agent_id" => 171717,
];
$mpesa->b2c($data, function($response) {
	print_r($response);
});

/* Transfer to business */
$data = [
	"value" => 10,
	"client_number" => "258850375093",
	"agent_id" => 171717,
];
$mpesa->c2b($data, function($response) {
	print_r($response);
});

/* Transfer from business to business */
$data = [
	"value" => 10,
	"agent_id" => 171717,
	"agent_receiver_id" => 979797,
];
$mpesa->b2b($data, function($response) {
	print_r($response);
});