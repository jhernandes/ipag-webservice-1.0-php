# IPAG SDK PHP v1.2.2

Integração em PHP com o Webservice iPag 1.0

## Dependências
* PHP >= 5.4

## Instalação

Se já possui um arquivo `composer.json`, basta adicionar a seguinte dependência ao seu projeto:

```json
"require": {
    "jhernandes/ipag-webservice-1.0-php":"~1.2"
}
```

Com a dependência adicionada ao `composer.json`, basta executar:

```
composer install
```

Alternativamente, você pode executar diretamente em seu terminal:

```
composer require jhernandes/ipag-webservice-1.0-php
```

## EXEMPLO DE TRANSAÇÃO COM CARTÃO (Payment Request)

```php
<?php

require 'vendor/autoload.php';

use Ipag\Ipag;
use Ipag\Order;
use Ipag\Payment;
use Ipag\Transaction;

$ipag = new Ipag('seu_id_ipag', Ipag::TEST);

$order =    $ipag->order(Order::OPERATION_PAYMENT, 'http://minhaurl.dev','20161109003', 1.00, '1');
$card =     $ipag->card('4556657802832607', 'SENHOR TESTE', '10', '21', '123');
$payment =  $ipag->payment(Payment::CREDIT_VISA, $card);
$customer = $ipag->customer('SENHOR TESTE', 'senhor@teste.com.br', '12312312333','1839161627');
$address =  $ipag->address('Rua Teste', '123', 'Bairro Teste', '', '20000-000', 'São Paulo', 'SP', 'BR');
$customer->setAddress($address);

$tx = $ipag->transaction($order, $payment, $customer);

$response = $ipag->paymentRequest($tx);

if (!$response->hasError()) {
    var_dump(print_r($response, true));
    exit;
}
echo $response->getErrorMessage();
exit;
```

## EXEMPLO DE TRANSAÇÃO COM BOLETO (Payment Request)

```php
<?php

require 'vendor/autoload.php';

use Ipag\Ipag;
use Ipag\Order;
use Ipag\Payment;
use Ipag\Transaction;

$ipag = new Ipag('seu_id_ipag', Ipag::TEST);

$order =    $ipag->order(Order::OPERATION_PAYMENT, 'http://minhaurl.dev','20161109003', 1.00, '1');

$payment =  $ipag->payment(Payment::BANKSLIP_BB);
$customer = $ipag->customer('SENHOR TESTE', 'senhor@teste.com.br', '12312312333','1839161627');
$address =  $ipag->address('Rua Teste', '123', 'Bairro Teste', '', '20000-000', 'São Paulo', 'SP', 'BR');
$customer->setAddress($address);

$tx = $ipag->transaction($order, $payment, $customer);

$response = $ipag->paymentRequest($tx);

if (!$response->hasError()) {
    var_dump(print_r($response, true));
    exit;
}
echo $response->getErrorMessage();
exit;
```

*Caso tenha sucesso o link para o boleto estará em $response->getUrlAuthentication();*

## EXEMPLO DE CONSULTA DE TRANSAÇÃO (Consult Request)

```php
<?php

require 'vendor/autoload.php';

use Ipag\Ipag;
use Ipag\Order;
use Ipag\Payment;
use Ipag\Transaction;

$ipag = new Ipag('seu_id_ipag', Ipag::TEST);

$order = $ipag->order(Order::OPERATION_CONSULT, 'http://minhaurl.dev');
//Caso não tenha o TID e tenha o OrderId (Número do pedido)
// $order = $ipag->order(Order::OPERATION_CONSULT, 'http://minhaurl.dev', '20161109003');

$tx = $ipag->transaction($order);
$tx->setTid('100699306900087B7BDA');

$response = $ipag->consultRequest($tx);

if (!$response->hasError()) {
    var_dump(print_r($response, true));
    exit;
}
echo $response->getErrorMessage();
exit;
```

## EXEMPLO DE CAPTURA DE TRANSAÇÃO (Capture Request)

```php
<?php

require 'vendor/autoload.php';

use Ipag\Ipag;
use Ipag\Order;
use Ipag\Payment;
use Ipag\Transaction;

$ipag = new Ipag('seu_id_ipag', Ipag::TEST);

$order = $ipag->order(Order::OPERATION_CAPTURE, 'http://minhaurl.dev');

$tx = $ipag->transaction($order);
//Para capturar é necessário ter um TID
$tx->setTid('100699306900087B7BDA');

$response = $ipag->captureRequest($tx);

if (!$response->hasError()) {
    var_dump(print_r($response, true));
    exit;
}
echo $response->getErrorMessage();
exit;
```
## EXEMPLO DE CANCELAMENTO DE TRANSAÇÃO (Cancel Request)

```php
<?php

require 'vendor/autoload.php';

use Ipag\Ipag;
use Ipag\Order;
use Ipag\Payment;
use Ipag\Transaction;

$ipag = new Ipag('seu_id_ipag', Ipag::TEST);

$order = $ipag->order(Order::OPERATION_CANCEL, 'http://minhaurl.dev');

$tx = $ipag->transaction($order);
//Para cancelar é necessário informar o TID
$tx->setTid('100699306900087B7BDA');

$response = $ipag->cancelRequest($tx);

if (!$response->hasError()) {
    var_dump(print_r($response, true));
    exit;
}
echo $response->getErrorMessage();
exit;
```

## EXEMPLO DE TRANSAÇÃO DE ASSINATURA (SUBSCRIPTION) [**NEW**]

```php
<?php

require 'vendor/autoload.php';

use Ipag\Ipag;
use Ipag\Order;
use Ipag\Payment;
use Ipag\Subscription;
use Ipag\Transaction;

$ipag = new Ipag('meu_id_ipag', Ipag::TEST);

$order    = $ipag->order(Order::OPERATION_PAYMENT, 'http://minhaurl.dev','201700001', 2.00, '1');
$card     = $ipag->card('4556657802832607', 'SENHOR TESTE', '10', '21', '123');
$payment  = $ipag->payment(Payment::CREDIT_VISA, $card);
$customer = $ipag
                ->customer('SENHOR TESTE', 'senhor@teste.com.br', '12312312333','1839161627')
                ->setAddress(
                    $ipag->address(
                        'Rua Teste', '123', 'Bairro Teste', '', '20000-000', 'São Paulo', 'SP', 'BR'
                    )
                );

$tx = $ipag
        ->transaction($order, $payment, $customer)
        ->setSubscription(
            $ipag
                //Assinatura mensal com inicio em 5 de janeiro de 2017
                ->subscription(Subscription::INTERVAL_MONTH,1,'05/01/2017')
                //Valor que será cobrado na assinatura após o período trial (promocional)
                ->setAmount(2.00)
                //Período trial mensal
                ->setTrialFrequency(1)
                ->setTrialCycle(3)
                //Valor que será cobrado no período trial
                ->setTrialAmount(1.20)
                //Primeira cobranca no ato da criação da transação será de R$1,00 apenas autorizado (não irá debitar do cartão de crédito do cliente)
                ->setTrial(true)
        );

$response = $ipag->paymentRequest($tx);

if (!$response->hasError()) {
    var_dump(print_r($response, true));
    exit;
}
echo $response->getErrorMessage();
exit;
```

## EXEMPLO DE TRANSAÇÃO COM SPLIT (CARTÃO) (Payment Request)

```php
<?php

require 'vendor/autoload.php';

use Ipag\Ipag;
use Ipag\Order;
use Ipag\Payment;
use Ipag\Transaction;

$ipag = new Ipag('seu_id_ipag', Ipag::TEST);
$ipag->setPartner('id_parceiro');

$order =    $ipag->order(Order::OPERATION_PAYMENT, 'http://minhaurl.dev','20161109003', 1.00, '1');
$card =     $ipag->card('4556657802832607', 'SENHOR TESTE', '10', '21', '123');
$payment =  $ipag->payment(Payment::CREDIT_VISA, $card);
$customer = $ipag->customer('SENHOR TESTE', 'senhor@teste.com.br', '12312312333','1839161627');
$address =  $ipag->address('Rua Teste', '123', 'Bairro Teste', '', '20000-000', 'São Paulo', 'SP', 'BR');
$customer->setAddress($address);

$tx = $ipag->transaction($order, $payment, $customer);

$response = $ipag->paymentRequest($tx);

if (!$response->hasError()) {
    var_dump(print_r($response, true));
    exit;
}
echo $response->getErrorMessage();
exit;
```
