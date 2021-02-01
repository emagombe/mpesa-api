# mpesa-api
API escrito em PHP para M-PESA (Moçambique)

[![License: GPL v3](https://img.shields.io/badge/License-GPLv3-blue.svg)](https://www.gnu.org/licenses/gpl-3.0)

Esta API (Aplication programing interface), permite efectuar transações no m-pesa usando o PHP.

## Instalação
```bash
composer require emagombe/mpesa-api
```
## Implementação

Primeiramente crie uma conta no site https://developer.mpesa.vm.co.mz/ e obtenha a **api key** e o **public key**
```php
use emagombe\Mpesa;

$api_key = "";		# Aqui introduz a api key disponibilizada no site
$public_key = "";	# Aqui introduz o public key disponibilizado no site
$ssl = true;		# True se pretende utilizar uma conexão segura (SSL)

# Inicialização e criação do objecto
$mpesa = Mpesa::init($api_key, $public_key, $ssl);
```
### Transferência business to client (de negócio para cliente)
Nesta operação, é transferido valor do agente para o clinte
```php
$data = [
	"value" => 10,	# Valor a transferir
	"client_number" => "123456789",	# Número do cliente beneficiário
	"agent_id" => 171717,	# Código do agente
];
$mpesa->b2c($data, function($response) {
	print_r($response);
});
```
### Transferência client to business (de cliente para negócio)
Nesta operação, é transferido valor do cliente para o agente
```php
$data = [
	"value" => 10,	# Valor a transferir
	"client_number" => "123456789",	# Número do cliente
	"agent_id" => 171717,	# Código do agente beneficiário
];
$mpesa->c2b($data, function($response) {
	print_r($response);
});
```
### Transferência business to business (de negócio para negócio)
Nesta operação, é transferido valor de agente para agente
```php
$data = [
	"value" => 10,	# Valor a transferir
	"agent_id" => 171717,	# Código do agente
	"agent_receiver_id" => 979797,	# Código do agente beneficiário
];
$mpesa->b2b($data, function($response) {
	print_r($response);
});
```
