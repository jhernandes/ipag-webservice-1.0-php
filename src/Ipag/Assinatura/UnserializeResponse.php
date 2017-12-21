<?php

namespace Ipag\Assinatura;

use Ipag\Services\XmlService;

class UnserializeResponse
{
    /**
     * Desserializa a resposta XML do iPag
     * @param string $message
     * @return Response
     */
    public function unserialize($message)
    {
        $doc = XmlService::isValid($message);

        if (!$doc) {
            $response->error = '999';
            $response->errorMessage = 'Não foi possível recuperar uma resposta do iPag';
            return $response;
        }

        return $this->xmlToObject($doc);
    }

    protected function xmlToObject($xml)
    {
        return json_decode(json_encode((array) $xml));
    }
}
