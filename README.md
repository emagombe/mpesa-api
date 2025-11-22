# mpesa-api

[![License: GPL v3](https://img.shields.io/badge/License-GPLv3-blue.svg)](https://www.gnu.org/licenses/gpl-3.0)

API PHP para integração com M-PESA (Moçambique).

## Instalação

```bash
composer require emagombe/mpesa-api
```

## Configuração

Obtenha as credenciais em https://developer.mpesa.vm.co.mz/

```php
use emagombe\Mpesa;

$mpesa = Mpesa::init(
    $api_key,        // API Key do portal
    $public_key,     // Public Key do portal
    "development"    // "development" ou "production"
);
```

## Operações

### C2B (Cliente → Negócio)

```php
$response = $mpesa->c2b([
    "value" => 10,
    "client_number" => "258840000000",
    "agent_id" => 171717,
    "transaction_reference" => 1234567,
    "third_party_reference" => 33333
]);

print_r($response);
```

### B2C (Negócio → Cliente)

```php
$response = $mpesa->b2c([
    "value" => 10,
    "client_number" => "258840000000",
    "agent_id" => 171717,
    "transaction_reference" => 1234567,
    "third_party_reference" => 33333
]);

print_r($response);
```

### B2B (Negócio → Negócio)

```php
$response = $mpesa->b2b([
    "value" => 10,
    "agent_id" => 171717,
    "agent_receiver_id" => 979797,
    "transaction_reference" => 1234567,
    "third_party_reference" => 33333
]);

print_r($response);
```

### Reversão

```php
$response = $mpesa->reversal([
    "value" => 10,
    "security_credential" => "",
    "indicator_identifier" => "",
    "transaction_id" => "",
    "agent_id" => 171717,
    "third_party_reference" => 33333
]);

print_r($response);
```

### Consultar Estado

```php
$response = $mpesa->status([
    "transaction_id" => "",
    "agent_id" => 171717,
    "third_party_reference" => 33333
]);
```

### Nome do Cliente

**Nota:** Requer credenciais de produção.

```php
$response = $mpesa->customer_name([
    "client_number" => "258840000000",
    "agent_id" => 171717,
    "third_party_reference" => 33333
]);
```

## Resposta de Sucesso

```json
{
    "output_ResponseCode": "INS-0",
    "output_ResponseDesc": "Request processed successfully",
    "output_TransactionID": "...",
    "output_ConversationID": "...",
    "output_ThirdPartyReference": "33333"
}
```

## Licença

GPL v3