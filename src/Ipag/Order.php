<?php namespace Ipag;

class Order
{
    /**
     * @var string
     */
    const RETURN_XML = 'xml';

    const OPERATION_PAYMENT = 'Pagamento';
    const OPERATION_CONSULT = 'Consulta';
    const OPERATION_CAPTURE = 'Captura';
    const OPERATION_CANCEL = 'Cancela';

    /**
     * @var string
     */
    private $orderId;

    /**
     * @var string
     */
    private $operation;

    /**
     * @var string
     */
    private $callbackUrl;

    /**
     * @var string
     */
    private $returnType = Order::RETURN_XML;

    /**
     * @var double
     */
    private $amount;

    /**
     * @var int
     */
    private $installments;

    /**
     * @var string
     */
    private $expiry;

    /**
     * @var string
     */
    private $fingerprint;

    /**
     * @param string $operation
     * @param string $callbackUrl
     * @param string $orderId
     * @param double $amount
     * @param int $installments
     * @param string $returnType
     *
     * @return self
     */
    public function __construct(
        $operation,
        $callbackUrl = Order::RETURN_XML,
        $orderId,
        $amount = null,
        $installments = null,
        $returnType = Order::RETURN_XML
    ) {
        is_null($orderId) ?: $this->setOrderId((string) $orderId);
        is_null($amount) ?: $this->setAmount($amount);
        is_null($installments) ?: $this->setInstallments((int) $installments);
        $this->setOperation((string) $operation);
        $this->setCallbackUrl((string) $callbackUrl);
        $this->setReturnType((string) $returnType);

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
     * Get the value of Operation
     *
     * @return string
     */
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * Get the value of Callback Url
     *
     * @return string
     */
    public function getCallbackUrl()
    {
        return $this->callbackUrl;
    }

    /**
     * Get the value of Return Type
     *
     * @return string
     */
    public function getReturnType()
    {
        return $this->returnType;
    }

    /**
     * Get the value of Amount
     *
     * @return double
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Get the value of Installments
     *
     * @return int
     */
    public function getInstallments()
    {
        return $this->installments;
    }

    /**
     * Set the value of Order Id
     *
     * @param string $orderId
     * @throws \UnexpectedValueException se o nome do cliente não for
     * do tipo `string` ou exceder 20 caracteres
     *
     * @return self
     */
    public function setOrderId($orderId)
    {
        if (!is_string($orderId) || strlen($orderId) > 20) {
            throw new \UnexpectedValueException(
                'O nome do cliente deve ser uma string com, no máximo, 20 caracteres'
            );
        }
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * Set the value of Operation
     *
     * @param string $operation
     * @throws \UnexpectedValueException se a operação não for Pagamento, Consulta,
     * Captura ou Cancela
     *
     * @return self
     */
    public function setOperation($operation)
    {
        $allowedOperations = array(
            Order::OPERATION_PAYMENT,
            Order::OPERATION_CONSULT,
            Order::OPERATION_CAPTURE,
            Order::OPERATION_CANCEL,
            null,
        );

        if (!in_array($operation, $allowedOperations, true)) {
            throw new \UnexpectedValueException(
                'O tipo de operação (operation) não é válido'
            );
        }
        $this->operation = $operation;

        return $this;
    }

    /**
     * Set the value of Callback Url
     *
     * @param string $callbackUrl
     *
     * @return self
     */
    public function setCallbackUrl($callbackUrl)
    {
        $this->callbackUrl = $callbackUrl;

        return $this;
    }

    /**
     * Set the value of Return Type
     *
     * @param string $returnType
     * @throws \UnexpectedValueException se o retorno tipo não for xml ou null
     *
     * @return self
     */
    public function setReturnType($returnType)
    {
        $allowedTypes = array(
            Order::RETURN_XML,
            null,
        );

        if (!in_array($returnType, $allowedTypes, true)) {
            throw new \UnexpectedValueException(
                'O tipo de retorno (returnType) não é válido'
            );
        }
        $this->returnType = $returnType;

        return $this;
    }

    /**
     * Set the value of Amount
     *
     * @param double $amount
     *
     * @return self
     */
    public function setAmount($amount)
    {
        $amount = (double) number_format(str_replace(",", ".", $amount), 2, ".", "");
        if (!is_double($amount)) {
            throw new \UnexpectedValueException(
                'O Valor do Pedido deve ser do tipo double'
            );
        }
        $this->amount = $amount;

        return $this;
    }

    /**
     * Set the value of Installments
     *
     * @param int $installments
     *
     * @throws Se a parcela não for inteiro ou ter mais que 2 caracteres
     *
     * @return self
     */
    public function setInstallments($installments)
    {
        if (!is_int($installments) || strlen($installments) < 1 || strlen($installments) > 2) {
            throw new \UnexpectedValueException(
                'Se as parcelas não forem do tipo inteiro ou tiverem mais que 2 caracteres'
            );
        }
        $this->installments = $installments;

        return $this;
    }

    /**
     * @return string
     */
    public function getExpiry()
    {
        return $this->expiry;
    }

    /**
     * @param string $expiry
     *
     * @return self
     */
    public function setExpiry($expiry)
    {
        if (preg_match("/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/", $expiry, $matches)) {
            if (!checkdate($matches[2], $matches[1], $matches[3])) {
                throw new \UnexpectedValueException('Informe uma data de vecimento válida.');
            }
            $this->expiry = $expiry;
        } else {
            throw new \UnexpectedValueException(
                'A data de vencimento deve ser informada utilizando o formato dd/mm/yyyy'
            );
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getFingerprint()
    {
        return $this->fingerprint;
    }

    /**
     * @param string $fingerprint
     *
     * @return self
     */
    public function setFingerprint($fingerprint)
    {
        $this->fingerprint = substr($fingerprint, 0, 120);

        return $this;
    }
}
