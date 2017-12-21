<?php namespace Ipag;

class Subscription
{
    const INTERVAL_DAY = 'day';
    const INTERVAL_WEEK = 'week';
    const INTERVAL_MONTH = 'month';
    const INTERVAL_YEAR = 'year';

    /**
     * @var int
     */
    private $frequency;

    /**
     * @var int
     */
    private $interval;

    /**
     * @var string
     */
    private $start;

    /**
     * @var int
     */
    private $cycle;

    /**
     * @var double
     */
    private $amount;

    /**
     * @var boolean
     */
    private $trial;

    /**
     * @var int
     */
    private $trialCycle;

    /**
     * @var int
     */
    private $trialFrequency;

    /**
     * @var double
     */
    private $trialAmount;

    /**
     * Subscription Constructor
     *
     * @param int $interval
     * @param int $frequency
     * @param string $start
     * @param int|null $cycle
     *
     * @return self
     */
    public function __construct($interval, $frequency, $start, $cycle = null)
    {
        $this->setInterval((string) $interval);
        $this->setFrequency((int) $frequency);
        $this->setStart($start);
        is_null($cycle) ?: $this->setCycle($cycle);

        return $this;
    }

    /**
     * Gets the value of frequency.
     *
     * @return int
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * Gets the value of interval.
     *
     * @return int
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * Gets the value of start.
     *
     * @return string
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Gets the value of cycle.
     *
     * @return int
     */
    public function getCycle()
    {
        return $this->cycle;
    }

    /**
     * Gets the value of amount.
     *
     * @return double
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Gets the value of trial.
     *
     * @return boolean
     */
    public function getTrial()
    {
        return $this->trial;
    }

    /**
     * Gets the value of trialCycle.
     *
     * @return int
     */
    public function getTrialCycle()
    {
        return $this->trialCycle;
    }

    /**
     * Gets the value of trialFrequency.
     *
     * @return int
     */
    public function getTrialFrequency()
    {
        return $this->trialFrequency;
    }

    /**
     * Gets the value of trialAmount.
     *
     * @return double
     */
    public function getTrialAmount()
    {
        return $this->trialAmount;
    }

    /**
     * Sets the value of frequency.
     *
     * @param int $frequency the frequency
     *
     * @return self
     */
    public function setFrequency($frequency)
    {
        if (!is_numeric($frequency) || strlen($frequency) < 1 || strlen($frequency) > 2) {
            throw new \UnexpectedValueException(
                'A frequencia não é válida ou não tem entre 1 e 2 caracteres'
            );
        }
        $this->frequency = $frequency;

        return $this;
    }

    /**
     * Sets the value of interval.
     *
     * @param int $interval the interval
     *
     * @return self
     */
    public function setInterval($interval)
    {
        switch ($interval) {
            case Subscription::INTERVAL_DAY:
            case Subscription::INTERVAL_WEEK:
            case Subscription::INTERVAL_MONTH:
            case Subscription::INTERVAL_YEAR:
                $this->interval = $interval;
                break;
            default:
                throw new \UnexpectedValueException(
                    'O tipo de intervalo (interval) não é válido'
                );
                break;
        }

        return $this;
    }

    /**
     * Sets the value of start.
     *
     * @param string $start the start
     *
     * @return self
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

        return $this;
    }

    /**
     * Sets the value of cycle.
     *
     * @param int $cycle the cycle
     *
     * @return self
     */
    public function setCycle($cycle)
    {
        if (!is_numeric($cycle) || strlen($cycle) < 1 || strlen($cycle) > 3) {
            throw new \UnexpectedValueException(
                'O ciclo deve ser númerico e ter entre 1 e 3 caracteres.'
            );
        }
        $this->cycle = $cycle;

        return $this;
    }

    /**
     * Sets the value of amount.
     *
     * @param double $amount the amount
     *
     * @return self
     */
    public function setAmount($amount)
    {
        if (!is_double($amount)) {
            throw new \UnexpectedValueException(
                'O Valor do Pedido deve ser do tipo double (ex: 1.00)'
            );
        }
        $this->amount = $amount;

        return $this;
    }

    /**
     * Sets the value of trial.
     *
     * @param boolean $trial the trial
     *
     * @return self
     */
    public function setTrial($trial)
    {
        $this->trial = (boolean) $trial;

        return $this;
    }

    /**
     * Sets the value of trialCycle.
     *
     * @param int $trialCycle the trial cycle
     *
     * @return self
     */
    public function setTrialCycle($trialCycle)
    {
        if (!is_numeric($trialCycle) || strlen($trialCycle) < 1 || strlen($trialCycle) > 3) {
            throw new \UnexpectedValueException(
                'O ciclo trial deve ser númerico e ter entre 1 e 3 caracteres.'
            );
        }
        $this->trialCycle = $trialCycle;

        return $this;
    }

    /**
     * Sets the value of trialFrequency.
     *
     * @param int $trialFrequency the trial frequency
     *
     * @return self
     */
    public function setTrialFrequency($trialFrequency)
    {
        if (!is_numeric($trialFrequency) || strlen($trialFrequency) < 1 || strlen($trialFrequency) > 2) {
            throw new \UnexpectedValueException(
                'A frequencia trial não é válida ou não tem entre 1 e 2 caracteres'
            );
        }
        $this->trialFrequency = $trialFrequency;

        return $this;
    }

    /**
     * Sets the value of trialAmount.
     *
     * @param double $trialAmount the trial amount
     *
     * @return self
     */
    public function setTrialAmount($trialAmount)
    {
        if (!is_double($trialAmount)) {
            throw new \UnexpectedValueException(
                'O Valor do Pedido deve ser do tipo double (ex: 1.00)'
            );
        }
        $this->trialAmount = $trialAmount;

        return $this;
    }
}
