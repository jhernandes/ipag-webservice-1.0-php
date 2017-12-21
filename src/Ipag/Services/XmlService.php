<?php

namespace Ipag\Services;

class XmlService
{
    /**
     * Verifica se o XML é válido
     * @param xml $message
     * @return mixed
     */
    public static function isValid($message)
    {
        libxml_use_internal_errors(true);
        $response = simplexml_load_string($message, 'SimpleXMLElement', LIBXML_NOCDATA);

        if ($response === false) {
            return false;
        }
        return $response;
    }
}
