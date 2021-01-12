# mpesa-api
API em PHP para M-PESA (Moçambique)

```php
use emagombe\Mpesa;

$api_key = "";
$public_key = "";
$ssl = true;
$mpesa = Mpesa::init($api_key, $public_key, $ssl);
```

```php
/* Transfer to client */
$data = [
	"value" => 10,
	"client_number" => "258850375093",
	"agent_id" => 171717,
];
$mpesa->b2c($data, function($response) {
	print_r($response);
});
```

```php
/* Transfer to business */
$data = [
	"value" => 10,
	"client_number" => "258850375093",
	"agent_id" => 171717,
];
$mpesa->c2b($data, function($response) {
	print_r($response);
});
```

```php
/* Transfer from business to business */
$data = [
	"value" => 10,
	"agent_id" => 171717,
	"agent_receiver_id" => 979797,
];
$mpesa->b2b($data, function($response) {
	print_r($response);
});
```