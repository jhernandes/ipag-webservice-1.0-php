<?php namespace Ipag\Serializer;

use Ipag\IpagException;
use Ipag\Response;

class IpagResponse
{
    public function unserialize($message)
    {
        libxml_use_internal_errors(true);
        $doc = simplexml_load_string($message);

        if (!$doc) {
            echo $doc;
            exit;
            // throw new IpagException('Não foi possível concluir a operação.', '10000');
        }

        $response = new Response();

        !isset($doc->erro)?:               $response->setError((string)$doc->erro);
        !isset($doc->mensagem)?:           $response->setErrorMessage((string)$doc->mensagem);
        !isset($doc->id_transacao)?:       $response->setTid((string)$doc->id_transacao);
        !isset($doc->valor)?:              $response->setAmount((string)$doc->valor);
        !isset($doc->num_pedido)?:         $response->setOrderId((string)$doc->num_pedido);
        !isset($doc->status_pagamento)?:   $response->setPaymentStatus((string)$doc->status_pagamento);
        !isset($doc->mensagem_transacao)?: $response->setTransactionMessage((string)$doc->mensagem_transacao);
        !isset($doc->metodo)?:             $response->setMethod((string)$doc->metodo);
        !isset($doc->operadora)?:          $response->setOperator((string)$doc->operadora);
        !isset($doc->operadora_mensagem)?: $response->setOperatorMessage((string)$doc->operadora_mensagem);
        !isset($doc->id_librepag)?:        $response->setIpagId((string)$doc->id_librepag);
        !isset($doc->autorizacao_id)?:     $response->setAuthId((string)$doc->autorizacao_id);
        !isset($doc->url_autenticacao)?:   $response->setUrlAuthentication((string)$doc->url_autenticacao);

        return $response;
    }
}
