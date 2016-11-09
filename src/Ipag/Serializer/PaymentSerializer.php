<?php namespace Ipag\Serializer;

use Ipag\Transaction;

class PaymentSerializer
{
    /**
     * @param  Transaction $tx
     * @return array
     */
    public function serialize(Transaction $tx)
    {
        $message = array(
            //User
            'identificacao'   => urlencode($tx->getUser()->getIdentification()),
            //Order
            'pedido'          => urlencode($tx->getOrder()->getOrderId()),
            'operacao'        => urlencode($tx->getOrder()->getOperation()),
            'url_retorno'     => urlencode($tx->getOrder()->getCallbackUrl()),
            'retorno_tipo'    => urlencode('xml'),
            'boleto_tipo'     => urlencode('xml'),
            'valor'           => urlencode($tx->getOrder()->getAmount()),
            'parcelas'        => urlencode($tx->getOrder()->getInstallments()),
            //Payment
            'metodo'          => urlencode($tx->getPayment()->getMethod()),
        );

        //Card
        if (!is_null($tx->getPayment()->getCard())) {
            $card = $tx->getPayment()->getCard();
            if (!is_null($card->getToken())) {
                $message['token_cartao'] =   urlencode($card->getToken());
            } else {
                $message['num_cartao'] =     urlencode($card->getNumber());
                $message['nome_cartao'] =    urlencode($card->getHolder());
                $message['mes_cartao'] =     urlencode($card->getExpireMonth());
                $message['ano_cartao'] =     urlencode($card->getExpireYear());
                if (!is_null($card->getCvv())) {
                    $message['cvv_cartao'] = urlencode($card->getCvv());
                }
            }
        }

        //Customer
        if (!is_null($tx->getCustomer())) {
            $customer = $tx->getCustomer();
            $message['nome'] =  urlencode($customer->getName());
            $message['email'] = urlencode($customer->getEmail());
            $message['doc'] =   urlencode($customer->getIdentity());
            $message['fone'] =  urlencode($customer->getPhone());
        }

        //Customer Address
        if (!is_null($tx->getCustomer()->getAddress())) {
            $address = $tx->getCustomer()->getAddress();
            $message['endereco'] =        urlencode($address->getStreet());
            $message['numero_endereco'] = urlencode($address->getNumber());
            $message['complemento'] =     urlencode($address->getComplement());
            $message['bairro'] =          urlencode($address->getNeighborhood());
            $message['cidade'] =          urlencode($address->getCity());
            $message['estado'] =          urlencode($address->getState());
            $message['pais'] =            urlencode($address->getCountry());
            $message['cep'] =             urlencode($address->getZipCode());

        }

        //Recorrência
        if (!is_null($tx->getPayment()->getFrequency())) {
            $message['frequencia'] = $tx->getPayment()->getFrequency();
        }
        if (!is_null($tx->getPayment()->getInterval())) {
            $message['intervalo'] = $tx->getPayment()->getInterval();
        }
        if (!is_null($tx->getPayment()->getStart())) {
            $message['inicio'] = $tx->getPayment()->getStart();
        }
        if (!is_null($tx->getPayment()->getCycle())) {
            $message['ciclos'] = $tx->getPayment()->getCycle();
        }
        return $message;
    }
}
