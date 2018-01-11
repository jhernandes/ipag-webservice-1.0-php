<?php namespace Ipag\Serializer;

use Ipag\Response;
use Ipag\Services\XmlService;

class IpagResponse
{
    /**
     * Desserializa a resposta XML do iPag
     * @param string $message
     * @return Response
     */
    public function unserialize($message)
    {
        $response = new Response();
        $doc = XmlService::isValid($message);

        if (!$doc) {
            $response->setError('999');
            $response->setErrorMessage('Não foi possível recuperar uma resposta do iPag');
            return $response;
        }

        !isset($doc->id_transacao) ?: $response->setTid((string) $doc->id_transacao);
        !isset($doc->valor) ?: $response->setAmount((string) $doc->valor);
        !isset($doc->num_pedido) ?: $response->setOrderId((string) $doc->num_pedido);
        !isset($doc->status_pagamento) ?: $response->setPaymentStatus((string) $doc->status_pagamento);
        !isset($doc->mensagem_transacao) ?: $response->setTransactionMessage((string) $doc->mensagem_transacao);
        !isset($doc->metodo) ?: $response->setMethod((string) $doc->metodo);
        !isset($doc->operadora) ?: $response->setOperator((string) $doc->operadora);
        !isset($doc->operadora_mensagem) ?: $response->setOperatorMessage((string) $doc->operadora_mensagem);
        !isset($doc->id_librepag) ?: $response->setIpagId((string) $doc->id_librepag);
        !isset($doc->autorizacao_id) ?: $response->setAuthId((string) $doc->autorizacao_id);
        !isset($doc->url_autenticacao) ?: $response->setUrlAuthentication((string) $doc->url_autenticacao);

        //TOKEN
        !isset($doc->token) ?: $response->setToken((string) $doc->token);
        !isset($doc->last4) ?: $response->setLast4((string) $doc->last4);
        !isset($doc->mes) ?: $response->setMes((string) $doc->mes);
        !isset($doc->ano) ?: $response->setAno((string) $doc->ano);
        !isset($doc->id_assinatura) ?: $response->setIdAssinatura((string) $doc->id_assinatura);

        //ERROR
        !isset($doc->code) ?: $response->setError((string) $doc->code);
        !isset($doc->message) ?: $response->setErrorMessage((string) $doc->message);

        if (isset($doc->af_id)) {
            $response->getAntifraude()
                ->setId((string) $doc->af_id)
                ->setStatus((string) $doc->af_status)
                ->setScore((string) $doc->score)
                ->setMessage((string) $doc->af_message);
        }

        return $response;
    }
}
