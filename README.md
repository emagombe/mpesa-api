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
$environment = "development";		# production/development

# Inicialização e criação do objecto
$mpesa = Mpesa::init($api_key, $public_key, $environment);
```
### Transferência business to client (de negócio para cliente)
Transferência de valor do agente para o clinte
```php
$data = [
	"value" => 10,					# (Obrigatório) Valor a transferir
	"client_number" => "258840000000",			# (Obrigatório) Número do cliente beneficiário
	"agent_id" => 171717,				# (Obrigatório) Código do agente
	"transaction_reference" => 1234567		# (Obrigatório) Usado para atribuir uma referencia a transação
	"third_party_reference" => 33333,	# (Obrigatório) Esta referencia será usada para efectuar consulta das transações
];
$response = $mpesa->b2c($data);
print_r($response);
```
##### Provável resposta caso bem sucedido
```json
{
  "output_ResponseCode": "INS-0",
  "output_ResponseDesc": "Request processed successfully",
  "output_TransactionID": "wgzupjwc5mm9",
  "output_ConversationID": "ccf590fbfa1d4ff4a245b9c430a64220",
  "output_ThirdPartyReference": "33333"
}
```

### Transferência client to business (de cliente para negócio)
Transferência de valor do cliente para o agente
```php
$data = [
	"value" => 10,					# (Obrigatório) Valor a transferir
	"client_number" => "258840000000",			# (Obrigatório) Número do cliente
	"agent_id" => 171717,				# (Obrigatório) Código do agente beneficiário
	"transaction_reference" => 1234567		# (Obrigatório) Usando para atribuir uma referencia a transação
	"third_party_reference" => 33333,	# (Obrigatório) Esta referencia será usada para efectuar consulta das transações
];
$response = $mpesa->c2b($data);
print_r($response);
```
##### Provável resposta caso bem sucedido
```json
{
  "output_ResponseCode": "INS-0",
  "output_ResponseDesc": "Request processed successfully",
  "output_TransactionID": "3cr8whltpb6m",
  "output_ConversationID": "25230e0e20514ba790c1273b866e98d1",
  "output_ThirdPartyReference": "33333"
}
```

### Transferência business to business (de negócio para negócio)
Transferência de valor de agente para agente
```php
$data = [
	"value" => 10,					# (Obrigatório) Valor a transferir
	"agent_id" => 171717,				# (Obrigatório) Código do agente
	"agent_receiver_id" => 979797,			# (Obrigatório) Código do agente beneficiário
	"transaction_reference" => 1234567		# (Obrigatório) Usando para atribuir uma referencia a transação
	"third_party_reference" => 33333,	# (Obrigatório) Esta referencia será usada para efectuar consulta das transações
];
$response = $mpesa->b2b($data);
print_r($response);
```
##### Provável resposta caso bem sucedido
```json
{
  "output_ResponseCode": "INS-0",
  "output_ResponseDesc": "Request processed successfully",
  "output_TransactionID": "wdv2x712xjsx",
  "output_ConversationID": "1f427e27529e410ea433c79a253d7281",
  "output_ThirdPartyReference": "33333"
}
```

### Reversão de transação

```php
$data = [
	"value" => 10,
	"security_credential" => "",	# (Obrigatório)
	"indicator_identifier" => "",	# (Obrigatório)
	"transaction_id" => "",			# (Obrigatório) Id da transação a reverter
	"agent_id" => 171717,			# (Obrigatório) Código do agente
	"third_party_reference" => 33333,	# (Obrigatório) Esta referencia será usada para efectuar consulta das transações
];
$response = $mpesa->reversal($data);
print_r($response);
```
##### Provável resposta caso bem sucedido
```json
{
  "output_ResponseCode": "INS-0",
  "output_ResponseDesc": "Request processed successfully",
  "output_TransactionID": "18c9kqgagz7h",
  "output_ConversationID": "2af1dce322394316917307c5320add6d",
  "output_ThirdPartyReference": "33333"
}
```

### Estado da transação

```php
$data = [
	"transaction_id" => "",		# (Obrigatório) Id da transação a reverter
	"agent_id" => 171717,			# (Obrigatório) Código do agente
	"third_party_reference" => 33333,	# (Obrigatório) Esta referencia será usada para efectuar consulta das transações
];
$response = $mpesa->status($data);
print_r($response);
```
##### Provável resposta caso bem sucedido
```json
{
  "output_ResponseCode": "INS-0",
  "output_ResponseDesc": "Request processed successfully",
  "output_ResponseTransactionStatus": "Completed",
  "output_ConversationID": "7552194cb219468fa8da3356eed77feb",
  "output_ThirdPartyReference": "33333"
}
```

### Nome do cliente

O nome do cliente é retornado. Geralmente usado para confirmar se client_number introduzido está correcto.

Nota impotante: É impossível verificar o nome do cliente usando as credenciais de testes. É necessário obter credencias de produção para que possa visualizar o nome do cliente!

```php
$data = [
	"client_number" => "258840000000",	# (Obrigatório) Número do cliente
	"agent_id" => 171717,		# (Obrigatório) Código do agente
	"third_party_reference" => 33333,	# (Obrigatório) Esta referencia será usada para efectuar consulta das transações
];
$response = $mpesa->customer_name($data);
print_r($response);
```
##### Provável resposta caso bem sucedido
```json
{
  "output_ResponseCode": "INS-26",
  "output_ResponseDesc": "Not authorized",
  "output_ConversationID": "f4f9e06d93b7439eb79bd61c7de6f642",
  "output_ThirdPartyReference": "33333",
  "output_CustomerName": "N/A"
}
```