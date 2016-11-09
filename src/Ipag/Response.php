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
     */
    public function setTid($tid)
    {
        $this->tid = $tid;
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
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
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
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
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
     */
    public function setPaymentStatus($paymentStatus)
    {
        $this->paymentStatus = $paymentStatus;
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
     */
    public function setTransactionMessage($transactionMessage)
    {
        $this->transactionMessage = $transactionMessage;
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
     */
    public function setMethod($method)
    {
        $this->method = $method;
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
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;
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
     */
    public function setOperatorMessage($operatorMessage)
    {
        $this->operatorMessage = $operatorMessage;
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
     */
    public function setIpagId($ipagId)
    {
        $this->ipagId = $ipagId;
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
     */
    public function setAuthId($authId)
    {
        $this->authId = $authId;
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
     */
    public function setUrlAuthentication($urlAuthentication)
    {
        $this->urlAuthentication = $urlAuthentication;
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
     */
    public function setError($error)
    {
        $this->error = $error;
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
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    /**
     * @return boolean
     */
    public function hasError()
    {
        return $this->error != null;
    }

    public function isApproved()
    {
        return ($this->getPaymentStatus() == '5' || $this->getPaymentStatus() == '8');
    }
}
