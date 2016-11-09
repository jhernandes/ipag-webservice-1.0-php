<?php namespace Ipag\Serializer;

use Ipag\Transaction;

class CancelSerializer
{
    /**
     * @param  Transaction $tx
     * @return array
     */
    public function serialize(Transaction $tx)
    {
        $message = array(
            'identificacao'  => urlencode($tx->getUser()->getIdentification()),
            'transId'        => urlencode($tx->getTid()),
            'url_retorno'    => urlencode($tx->getOrder()->getCallbackUrl()),
        );

        return $message;
    }
}
