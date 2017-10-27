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
            'identificacao' => urlencode($tx->getUser()->getIdentification()),
            //Order
            'pedido' => urlencode($tx->getOrder()->getOrderId()),
            'operacao' => urlencode($tx->getOrder()->getOperation()),
            'url_retorno' => urlencode($tx->getOrder()->getCallbackUrl()),
            'retorno_tipo' => urlencode('xml'),
            'boleto_tipo' => urlencode('xml'),
            'valor' => urlencode($tx->getOrder()->getAmount()),
            'parcelas' => urlencode($tx->getOrder()->getInstallments()),
            'vencto' => urlencode($tx->getOrder()->getExpiry()),
            //Payment
            'metodo' => urlencode($tx->getPayment()->getMethod()),
        );

        $instructions = $tx->getPayment()->getInstructions();
        foreach ($instructions as $key => $instruction) {
            $message["instrucoes[{$key}]"] = $instruction;
        }

        //Tem Parceiro?
        $parceiro = $tx->getUser()->getIdentification2();
        if (!empty($parceiro)) {
            $message['identificacao2'] = $parceiro;
        }

        //SoftDescriptor?
        $softDescriptor = $tx->getPayment()->getSoftDescriptor();
        if (!empty($softDescriptor)) {
            $message['softdescriptor'] = $softDescriptor;
        }

        //Card
        if (!is_null($tx->getPayment()->getCard())) {
            $card = $tx->getPayment()->getCard();
            if (!is_null($card->getToken())) {
                $message['token_cartao'] = urlencode($card->getToken());
            } else {
                $message['num_cartao'] = urlencode($card->getNumber());
                $message['nome_cartao'] = urlencode($card->getHolder());
                $message['mes_cartao'] = urlencode($card->getExpireMonth());
                $message['ano_cartao'] = urlencode($card->getExpireYear());
                if (!is_null($card->getCvv())) {
                    $message['cvv_cartao'] = urlencode($card->getCvv());
                }
                if ($card->getSave()) {
                    $message['gera_token_cartao'] = urlencode($card->getSave());
                }
            }
        }

        //Customer
        if (!is_null($tx->getCustomer())) {
            $customer = $tx->getCustomer();
            $message['nome'] = urlencode($customer->getName());
            $message['email'] = urlencode($customer->getEmail());
            $message['doc'] = urlencode($customer->getIdentity());
            $message['fone'] = urlencode($customer->getPhone());
        }

        //Customer Address
        if (!is_null($tx->getCustomer()->getAddress())) {
            $address = $tx->getCustomer()->getAddress();
            $message['endereco'] = urlencode($address->getStreet());
            $message['numero_endereco'] = urlencode($address->getNumber());
            $message['complemento'] = urlencode($address->getComplement());
            $message['bairro'] = urlencode($address->getNeighborhood());
            $message['cidade'] = urlencode($address->getCity());
            $message['estado'] = urlencode($address->getState());
            $message['pais'] = urlencode($address->getCountry());
            $message['cep'] = urlencode($address->getZipCode());
        }

        //Subscription
        if (!is_null($tx->getSubscription())) {
            $subscription = $tx->getSubscription();

            $message['frequencia'] = urlencode($subscription->getFrequency());
            $message['intervalo'] = urlencode($subscription->getInterval());
            $message['inicio'] = urlencode($subscription->getStart());
            $message['ciclos'] = urlencode($subscription->getCycle());
            $message['valor_rec'] = urlencode($subscription->getAmount());
            $message['trial'] = urlencode($subscription->getTrial());
            $message['trial_ciclos'] = urlencode($subscription->getTrialCycle());
            $message['trial_frequencia'] = urlencode($subscription->getTrialFrequency());
            $message['trial_valor'] = urlencode($subscription->getTrialAmount());
        }
        return $message;
    }
}
