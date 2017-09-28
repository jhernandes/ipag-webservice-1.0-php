# IPAG SDK PHP

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

##ENDPOINTS

Endpoint | Variável Estática
-------- | -----------------
Produção | Ipag::PRODUCTION
Sandbox  | Ipag::TEST

## OPERAÇÕES

Operação | Variável Estática
-------- | ----------------
Pagamento| Order::OPERATION_PAYMENT
Consulta | Order::OPERATION_CONSULT
Captura  | Order::OPERATION_CAPTURE
Cancela  | Order::OPERATION_CANCEL

## MÉTODOS DE PAGAMENTOS

Método | Tipo | Variável Estática
------ | -----| --------
visa | crédito | Payment::CREDIT_VISA
mastercard | crédito | Payment::CREDIT_MASTERCARD
amex | crédito | Payment::CREDIT_AMEX
elo | crédito | Payment::CREDIT_ELO
discover | crédito | Payment::CREDIT_DISCOVER
hipercard | crédito | Payment::CREDIT_HIPERCARD
jcb | crédito | Payment::CREDIT_JCB
diners | crédito |  Payment::CREDIT_DINERS
aura | crédito | Payment::CREDIT_AURA
visaelectron | débito | Payment::DEBIT_VISAELECTRON
maestro | débito | Payment::DEBIT_MAESTRO
boleto_itau | boleto | Payment::BANKSLIP_ITAU
boleto_cef | boleto | Payment::BANKSLIP_CEF
boleto_bradesco | boleto | Payment::BANKSLIP_BRADESCO
boleto_bb | boleto | Payment::BANKSLIP_BB
boleto_banespasantander | boleto | Payment::BANKSLIP_SANTANDER
boletozoop | boleto | Payment::BANKSLIP_ZOOP
boletostone | boleto | Payment::BANKSLIP_STONE
boletocielo | boleto | Payment::BANKSLIP_CIELO
boletoitaushopline | boleto | Payment::BANKSLIP_ITAUSHOPLINE
boletostelo | boleto | Payment::BANKSLIP_STELO
itaushopline | transferência | Payment::BANK_ITAUSHOPLINE
bancobrasil | transferência | Payment::BANK_BB

## MAPEAMENTO DOS CAMPOS

```php

<?php
$ipag = new Ipag(@ID_IPAG, @ENDPOINT);

$order =    $ipag->order(@OPERACAO, @URL_RETORNO, @NUMERO_PEDIDO, @VALOR, @PARCELAMENTO);

//Para adicionar vencimento (BOLETO)
// DD/MM/AAAA
//$order->setExpiry('21/10/2017');

$card =     $ipag->card(@NUMERO_CARTAO, @NOME_NO_CARTAO, @VENCIMENTO_MES, @VENCIMENTO_ANO, @CVV);
$payment =  $ipag->payment(@METODO, $card);
$customer = $ipag->customer(@NOME, @EMAIL, @CPF/CNPJ, @TELEFONE);
$address =  $ipag->address(@LOGRADOURO, @NUMERO, @BAIRRO, @COMPLEMENTO, @CEP, @CIDADE, @UF, @PAIS);
$customer->setAddress($address);
$tx = $ipag->transaction($order, $payment, $customer);
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

$order = $ipag->order(Order::OPERATION_PAYMENT, 'http://minhaurl.dev','20161109003', 1.00, '1');

//Para adicionar vencimento (BOLETO)
// DD/MM/AAAA
//$order->setExpiry('21/10/2017');

$payment = $ipag->payment(Payment::BANKSLIP_BB);
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

## EXEMPLO DE TRANSAÇÃO COM CARTÃO COM GERAÇÃO DE TOKEN (ONE-CLICK)

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

//Adicione esse parametro para que o token do cartão seja gerado para futuras compras utilizando o token.
$card->setSave(true);

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

## EXEMPLO DE TRANSAÇÃO UTILIZANDO TOKEN (ONE-CLICK Payment)

```php
<?php

require 'vendor/autoload.php';

use Ipag\Ipag;
use Ipag\Order;
use Ipag\Payment;
use Ipag\Transaction;

$ipag = new Ipag('seu_id_ipag', Ipag::TEST);

$order =    $ipag->order(Order::OPERATION_PAYMENT, 'http://minhaurl.dev','20161109003', 1.00, '1');
$card =     $ipag->card('KLJKLA-KUYAT-EBAST-YPLGV');

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