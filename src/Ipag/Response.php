<?php namespace Ipag;

class Response
{
    /**
     * @var string
     */
    private $tid;

    /**
     * @var string
     */
    private $amount;

    /**
     * @var string
     */
    private $orderId;

    /**
     * @var string
     */
    private $paymentStatus;

    /**
     * @var string
     */
    private $transactionMessage;

    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $operator;

    /**
     * @var string
     */
    private $operatorMessage;

    /**
     * @var string
     */
    private $ipagId;

    /**
     * @var string
     */
    private $authId;

    /**
     * @var string
     */
    private $urlAuthentication;

    /**
     * @var string
     */
    private $error;

    /**
     * @var string
     */
    private $errorMessage;

    /**
     * Get the value of Tid
     *
     * @return string
     */
    public function getTid()
    {
        return $this->tid;
    }

    /**
     * Set the value of Tid
     *
     * @param string tid
     *
     * @return self
     */
    public function setTid($tid)
    {
        $this->tid = $tid;

        return $this;
    }

    /**
     * Get the value of Amount
     *
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set the value of Amount
     *
     * @param string amount
     *
     * @return self
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get the value of Order Id
     *
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Set the value of Order Id
     *
     * @param string orderId
     *
     * @return self
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * Get the value of Payment Status
     *
     * @return string
     */
    public function getPaymentStatus()
    {
        return $this->paymentStatus;
    }

    /**
     * Set the value of Payment Status
     *
     * @param string paymentStatus
     *
     * @return self
     */
    public function setPaymentStatus($paymentStatus)
    {
        $this->paymentStatus = $paymentStatus;

        return $this;
    }

    /**
     * Get the value of Transaction Message
     *
     * @return string
     */
    public function getTransactionMessage()
    {
        return $this->transactionMessage;
    }

    /**
     * Set the value of Transaction Message
     *
     * @param string transactionMessage
     *
     * @return self
     */
    public function setTransactionMessage($transactionMessage)
    {
        $this->transactionMessage = $transactionMessage;

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
     * Set the value of Method
     *
     * @param string method
     *
     * @return self
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Get the value of Operator
     *
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * Set the value of Operator
     *
     * @param string operator
     *
     * @return self
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;

        return $this;
    }

    /**
     * Get the value of Operator Message
     *
     * @return string
     */
    public function getOperatorMessage()
    {
        return $this->operatorMessage;
    }

    /**
     * Set the value of Operator Message
     *
     * @param string operatorMessage
     *
     * @return self
     */
    public function setOperatorMessage($operatorMessage)
    {
        $this->operatorMessage = $operatorMessage;

        return $this;
    }

    /**
     * Get the value of Ipag Id
     *
     * @return string
     */
    public function getIpagId()
    {
        return $this->ipagId;
    }

    /**
     * Set the value of Ipag Id
     *
     * @param string ipagId
     *
     * @return self
     */
    public function setIpagId($ipagId)
    {
        $this->ipagId = $ipagId;

        return $this;
    }

    /**
     * Get the value of Auth Id
     *
     * @return string
     */
    public function getAuthId()
    {
        return $this->authId;
    }

    /**
     * Set the value of Auth Id
     *
     * @param string authId
     *
     * @return self
     */
    public function setAuthId($authId)
    {
        $this->authId = $authId;

        return $this;
    }

    /**
     * Get the value of Url Authentication
     *
     * @return string
     */
    public function getUrlAuthentication()
    {
        return $this->urlAuthentication;
    }

    /**
     * Set the value of Url Authentication
     *
     * @param string urlAuthentication
     *
     * @return self
     */
    public function setUrlAuthentication($urlAuthentication)
    {
        $this->urlAuthentication = $urlAuthentication;

        return $this;
    }

    /**
     * Get the value of Error
     *
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Set the value of Error
     *
     * @param string error
     *
     * @return self
     */
    public function setError($error)
    {
        $this->error = $error;

        return $this;
    }

    /**
     * Get the value of Error Message
     *
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * Set the value of Error Message
     *
     * @param string errorMessage
     *
     * @return self
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;

        return $this;
    }

    /**
     * @return boolean
     */
    public function hasError()
    {
        return $this->error != null;
    }

    /**
     * @return boolean
     */
    public function isApproved()
    {
        return ($this->getPaymentStatus() == '5');
    }

    /**
     * @return boolean
     */
    public function isCaptured()
    {
        return ($this->getPaymentStatus() == '8');
    }
}