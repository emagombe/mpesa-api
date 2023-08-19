# mpesa-api
API escrita em PHP para M-PESA (Moçambique)

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
	"value" => 10,					# (Obrigatório) Valor a transferir
	"client_number" => "123456789",			# (Obrigatório) Número do cliente beneficiário
	"agent_id" => 171717,				# (Obrigatório) Código do agente
	"transaction_reference" => "#ref-1234"		# (Obrigatório) Usado para atribuir uma referencia a transação
	"third_party_reference" => "business-1234",	# (Obrigatório) Esta referencia será usada para efectuar consulta das transações
];
$mpesa->b2c($data, function($response) {
	print_r($response);
});
```
### Transferência client to business (de cliente para negócio)
Nesta operação, é transferido valor do cliente para o agente
```php
$data = [
	"value" => 10,					# (Obrigatório) Valor a transferir
	"client_number" => "123456789",			# (Obrigatório) Número do cliente
	"agent_id" => 171717,				# (Obrigatório) Código do agente beneficiário
	"transaction_reference" => "#ref-1234"		# (Obrigatório) Usando para atribuir uma referencia a transação
	"third_party_reference" => "business-1234",	# (Obrigatório) Esta referencia será usada para efectuar consulta das transações
];
$mpesa->c2b($data, function($response) {
	print_r($response);
});
```
### Transferência business to business (de negócio para negócio)
Nesta operação, é transferido valor de agente para agente
```php
$data = [
	"value" => 10,					# (Obrigatório) Valor a transferir
	"agent_id" => 171717,				# (Obrigatório) Código do agente
	"agent_receiver_id" => 979797,			# (Obrigatório) Código do agente beneficiário
	"transaction_reference" => "#ref-1234"		# (Obrigatório) Usando para atribuir uma referencia a transação
	"third_party_reference" => "business-1234",	# (Obrigatório) Esta referencia será usada para efectuar consulta das transações
];
$mpesa->b2b($data, function($response) {
	print_r($response);
});
```

### Reversão de transação

```php
$data = [
	"value" => 10,
	"security_credential" => "",	# (Obrigatório)
	"indicator_identifier" => "",	# (Obrigatório)
	"transaction_id" => "",			# (Obrigatório) Id da transação a reverter
	"agent_id" => 171717,			# (Obrigatório) Código do agente
	"transaction_reference" => "#ref-1234"	# (Obrigatório) Usando para atribuir uma referencia a transação
	"third_party_reference" => "business-1234",	# (Obrigatório) Esta referencia será usada para efectuar consulta das transações
];
$mpesa->reversal($data, function($response) {
	print_r($response);
});
```

**Nota**: Se não indicar o parametro **transaction_reference** será gerado um código aleatório o qual será usado no parametro. O cógido é gerado com base no algorítimo do [uniqid](https://www.php.net/manual/en/function.uniqid.php)
