<?php namespace Ipag;

class Payment
{
    //methods
    const CREDIT_VISA        = 'visa';
    const CREDIT_MASTERCARD  = 'mastercard';
    const CREDIT_DINERS      = 'diners';
    const CREDIT_AMEX        = 'amex';
    const CREDIT_ELO         = 'elo';
    const CREDIT_DISCOVER    = 'discover';
    const CREDIT_HIPERCARD   = 'hipercard';
    const CREDIT_JCB         = 'jcb';
    const DEBIT_VISAELECTRON = 'visaelectron';
    const DEBIT_MAESTRO      = 'maestro';

    const BANKSLIP_ITAU      = 'boleto_itau';
    const BANKSLIP_CEF       = 'boleto_cef';
    const BANKSLIP_BRADESCO  = 'boleto_bradesco';
    const BANKSLIP_BB        = 'boleto_bb';
    const BANKSLIP_SANTANDER = 'boleto_banespasantander';
    const BANKSLIP_HSBC      = 'boleto_hsbc';

    const BANK_BRADESCO      = 'bradescopf';
    const BANK_ITAUSHOPLINE  = 'itaushopline';
    const BANK_BB            = 'bancobrasil';

    /**
     * @var string
     */
    private $method;

    /**
     * @var Card
     */
    private $card;

    /**
     * @param string $method
     * @param Card|null $card
     *
     * @return self
     */
    function __construct($method, $card = null)
    {
        $this->setMethod($method);
        is_null($card)?:$this->setCard($card);

        return $this;
    }

    /**
     * Get the value of Method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Get the value of Card
     *
     * @return Card
     */
    public function getCard()
    {
        return $this->card;
    }

    /**
     * Set the value of Method
     *
     * @param string $method
     * @throws \UnexpectedValueException se o método não for válido
     *
     * @return self
     */
    public function setMethod($method)
    {
        $allowedMethods = array(
            Payment::CREDIT_VISA,
            Payment::CREDIT_MASTERCARD,
            Payment::CREDIT_DINERS,
            Payment::CREDIT_AMEX,
            Payment::CREDIT_ELO,
            Payment::CREDIT_DISCOVER,
            Payment::CREDIT_HIPERCARD,
            Payment::CREDIT_JCB,
            Payment::DEBIT_VISAELECTRON,
            Payment::DEBIT_MAESTRO,
            Payment::BANKSLIP_ITAU,
            Payment::BANKSLIP_CEF,
            Payment::BANKSLIP_BRADESCO,
            Payment::BANKSLIP_BB,
            Payment::BANKSLIP_SANTANDER,
            Payment::BANKSLIP_HSBC,
            Payment::BANK_BRADESCO,
            Payment::BANK_ITAUSHOPLINE,
            Payment::BANK_BB
        );

        if (! in_array($method, $allowedMethods, true)) {
            throw new \UnexpectedValueException(
                'O tipo de método não é válido'
            );
        }
        $this->method = $method;

        return $this;
    }

    /**
     * Set the value of Card
     *
     * @param Card $card
     *
     * @return self
     */
    public function setCard(Card $card)
    {
        $this->card = $card;

        return $this;
    }
}
