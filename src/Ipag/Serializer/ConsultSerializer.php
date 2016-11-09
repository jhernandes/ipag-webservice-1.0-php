<?php namespace Ipag\Serializer;

use Ipag\Transaction;

class ConsultSerializer
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
            'numPedido'      => urlencode($tx->getOrder()->getOrderId()),
            'url_retorno'    => urlencode($tx->getOrder()->getCallbackUrl()),
            'retorno_tipo'   => urlencode($tx->getOrder()->getReturnType())
        );

        return $message;
    }
}
