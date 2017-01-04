<?php namespace Ipag;

class Card
{
    /**
     * @var string
     */
    private $number;

    /**
     * @var string
     */
    private $holder;

    /**
     * @var string
     */
    private $expireMonth;

    /**
     * @var string
     */
    private $expireYear;

    /**
     * @var string
     */
    private $cvv;

    /**
     * @var string
     */
    private $token;

    /**
     * @param string      $tokenOrNumber
     * @param null|string $holder
     * @param null|string $expireMonth
     * @param null|string $expireYear
     * @param int         $cvv
     *
     * @return self
     */
    public function __construct(
        $tokenOrNumber,
        $holder = null,
        $expireMonth = null,
        $expireYear = null,
        $cvv = null
    ) {
        if (func_num_args() == 1) {
            $this->setToken($tokenOrNumber);
            return $this;
        }

        $this->setNumber($tokenOrNumber);
        $this->setHolder($holder);
        $this->setExpireMonth($expireMonth);
        $this->setExpireYear($expireYear);
        is_null($cvv)?:$this->setCvv($cvv);

        return $this;
    }

    /**
    * Get the value of Number
    *
    * @return string
    */
    public function getNumber()
    {
       return $this->number;
    }

    /**
    * Get the value of Holder
    *
    * @return string
    */
    public function getHolder()
    {
       return $this->holder;
    }

    /**
    * Get the value of Expire Month
    *
    * @return string
    */
    public function getExpireMonth()
    {
       return $this->expireMonth;
    }

    /**
    * Get the value of Expire Year
    *
    * @return string
    */
    public function getExpireYear()
    {
       return $this->expireYear;
    }

    /**
    * Get the value of Cvv
    *
    * @return string
    */
    public function getCvv()
    {
       return $this->cvv;
    }

    /**
    * Get the value of Token
    *
    * @return string
    */
    public function getToken()
    {
       return $this->token;
    }

    /**
    * Set the value of Number
    *
    * @param string number
    * @throws \UnexpectedValueException se o número do cartão não for numérico
    * ou exceder 19 dígitos
    *
    * @return self
    */
    public function setNumber($number)
    {
        if (!is_numeric($number) || strlen($number) > 19) {
            throw new \UnexpectedValueException(
                'O número do cartão deve conter apenas números e ter no máximo 19 caracteres'
            );
        }
        $this->number = $number;

        return $this;
    }

    /**
    * Set the value of Holder
    *
    * @param string holder
    * @throws \UnexpectedValueException se o nome do portador do cartão não for
    * do tipo `string` ou exceder 50 caracteres
    *
    * @return self
    */
    public function setHolder($holder)
    {
        if (!is_string($holder) || strlen($holder) > 50) {
            throw new \UnexpectedValueException(
                'O nome do portador deve ser uma string com, no máximo, 50 caracteres'
            );
        }
        $this->holder = $holder;

        return $this;
    }

    /**
    * Set the value of Expire Month
    *
    * @param string expireMonth
    * @throws \UnexpectedValueException se o mês de expiração não for numérico
    * ou não estiver entre 1 e 12
    *
    * @return self
    */
    public function setExpireMonth($expireMonth)
    {
        if (!is_numeric($expireMonth) || $expireMonth < 1 || $expireMonth > 12) {
            throw new \UnexpectedValueException(
                'O mês de expiração do cartão deve ser um número entre 1 e 12'
            );
        }
        $this->expireMonth = $expireMonth;

        return $this;
    }

    /**
    * Set the value of Expire Year
    *
    * @param string expireYear
    * @throws \UnexpectedValueException se o ano de expiração não for numérico
    * ou não conter 2 dígitos
    *
    * @return self
    */
    public function setExpireYear($expireYear)
    {
        if (!is_numeric($expireYear) || strlen($expireYear) != 2) {
            throw new \UnexpectedValueException(
                'O ano de expiração do cartão deve ser um número de 2 dígitos'
            );
        }
        $this->expireYear = $expireYear;

        return $this;
    }

    /**
    * Set the value of Cvv
    *
    * @param string cvv
    * @throws \UnexpectedValueException se o CVV não for numérico ou não conter
    * 3 ou 4 dígitos
    *
    * @return self
    */
    public function setCvv($cvv)
    {
        if (!is_numeric($cvv) || strlen($cvv) < 3 || strlen($cvv) > 4) {
            throw new \UnexpectedValueException(
                'O código de segurança deve ser um número e deve ter 3 ou 4 caracteres'
            );
        }
        $this->cvv = $cvv;

        return $this;
    }

    /**
    * Set the value of Token
    *
    * @param string token
    * @throws \UnexpectedValueException se o token não tiver 36 caracteres ou não
    * for do tipo `string`
    *
    * @return self
    */
    public function setToken($token)
    {
        if (!is_string($token) || strlen($token) != 36) {
            throw new \UnexpectedValueException(
                'O token deve ser uma string com 36 caracteres'
            );
        }
        $this->token = $token;

        return $this;
    }

}
