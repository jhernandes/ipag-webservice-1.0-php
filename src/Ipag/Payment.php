<?php namespace Ipag;

class Payment
{
    const INTERVAL_DAY       = 'day';
    const INTERVAL_WEEK      = 'week';
    const INTERVAL_MONTH     = 'month';
    const INTERVAL_YEAR      = 'year';

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
     * @var int
     */
    private $frequency;

    /**
     * @var string
     */
    private $interval;

    /**
     * @var date|string
     */
    private $start;

    /**
     * @var int
     */
    private $cycle;

    /**
     * @param string $method
     * @param Card|null $card
     */
    function __construct($method, $card = null)
    {
        $this->setMethod($method);
        is_null($card)?:$this->setCard($card);
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
     * Get the value of Frequency
     *
     * @return int
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * Get the value of Interval
     *
     * @return string
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * Get the value of Start
     *
     * @return date|string
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Get the value of Cycle
     *
     * @return int
     */
    public function getCycle()
    {
        return $this->cycle;
    }

    /**
     * Set the value of Method
     *
     * @param string $method
     * @throws \UnexpectedValueException se o método não for válido
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
    }

    /**
     * Set the value of Card
     *
     * @param Card $card
     */
    public function setCard(Card $card)
    {
        $this->card = $card;
    }

    /**
     * Set the value of Frequency
     *
     * @param int $frequency
     * @throws \UnexpectedValueException Se frequencia não for númerico e
     * ter entre 1 e 2 caracteres
     */
    public function setFrequency($frequency)
    {
        if (!is_numeric($frequency) || strlen($frequency) < 1 || strlen($frequency) > 2) {
            throw new \UnexpectedValueException(
                'A frequencia deve ser númerico e ter entre 1 e 2 caracteres.'
            );
        }
        $this->frequency = $frequency;
    }

    /**
     * Set the value of Interval
     *
     * @param string $interval
     * @throws \UnexpectedValueException Se o tipo de intervalo não for `day`,
     * `week`, `month` ou `year`
     */
    public function setInterval($interval)
    {
        switch ($interval) {
            case Payment::INTERVAL_DAY:
            case Payment::INTERVAL_WEEK:
            case Payment::INTERVAL_MONTH:
            case Payment::INTERVAL_YEAR:
                 $this->interval = $interval;
                break;
            default:
                throw new \UnexpectedValueException(
                    'O tipo de intervalo (interval) não é válido'
                );
                break;
        }
    }

    /**
     * Set the value of Start
     *
     * @param string $start
     * @throws \UnexpectedValueException Se data não estiver em formato correto ou for inválida.
     */
    public function setStart($start)
    {
        if (preg_match("/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/", $start, $matches)) {
            if (!checkdate($matches[2], $matches[1], $matches[3])) {
                throw new \UnexpectedValueException('Informe uma data de início válida.');
            }
            $this->start = $start;
        } else {
            throw new \UnexpectedValueException('A data deve ser informada utilizando o formato dd/mm/yyyy');
        }
    }

    /**
     * Set the value of Cycle
     *
     * @param int $cycle
     * @throws \UnexpectedValueException O ciclo deve ser númerico e ter entre 1 e 3 caracteres.
     */
    public function setCycle($cycle)
    {
        if (!is_numeric($cycle) || strlen($cycle) < 1 || strlen($cycle) > 3) {
            throw new \UnexpectedValueException(
                'O ciclo deve ser númerico e ter entre 1 e 3 caracteres.'
            );
        }
        $this->cycle = $cycle;
    }




}
