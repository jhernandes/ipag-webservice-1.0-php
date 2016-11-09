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
    const OPERATION_VOID = 'Cancela';

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
     * @param string $orderId
     * @param double $amount
     * @param int $installments
     * @param string $operation
     * @param string $callbackUrl
     * @param string $returnType
     */
    function __construct(
        $orderId,
        $amount = null,
        $installments = null,
        $operation = null,
        $callbackUrl = Order::RETURN_XML,
        $returnType = Order::RETURN_XML
    ) {
        $this->setOrderId((string)$orderId);
        is_null($amount)?:$this->setAmount($amount);
        is_null($installments)?:$this->setInstallments((int)$installments);
        $this->setOperation((string)$operation);
        $this->setCallbackUrl((string)$callbackUrl);
        $this->setReturnType((string)$returnType);
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
     */
    public function setOrderId($orderId)
    {
        if (!is_string($orderId) || strlen($orderId) > 20) {
            throw new \UnexpectedValueException(
                'O nome do cliente deve ser uma string com, no máximo, 20 caracteres'
            );
        }
        $this->orderId = $orderId;
    }

    /**
     * Set the value of Operation
     *
     * @param string $operation
     * @throws \UnexpectedValueException se a operação não for Pagamento, Consulta,
     * Captura ou Cancela
     */
    public function setOperation($operation)
    {
        $allowedOperations = array(
            Order::OPERATION_PAYMENT,
            Order::OPERATION_CONSULT,
            Order::OPERATION_CAPTURE,
            Order::OPERATION_VOID,
            null,
        );

        if (! in_array($operation, $allowedOperations, true)) {
            throw new \UnexpectedValueException(
                'O tipo de operação (operation) não é válido'
            );
        }
        $this->operation = $operation;
    }

    /**
     * Set the value of Callback Url
     *
     * @param string $callbackUrl
     */
    public function setCallbackUrl($callbackUrl)
    {
        $this->callbackUrl = $callbackUrl;
    }

    /**
     * Set the value of Return Type
     *
     * @param string $returnType
     * @throws \UnexpectedValueException se o retorno tipo não for xml ou null
     */
    public function setReturnType($returnType)
    {
        $allowedTypes = array(
            Order::RETURN_XML,
            null,
        );

        if (! in_array($returnType, $allowedTypes, true)) {
            throw new \UnexpectedValueException(
                'O tipo de retorno (returnType) não é válido'
            );
        }
        $this->returnType = $returnType;
    }

    /**
     * Set the value of Amount
     *
     * @param double $amount
     */
    public function setAmount($amount)
    {
        if (!is_double($amount)) {
              throw new \UnexpectedValueException(
                  'O Valor do Pedido deve ser do tipo double'
              );
          }
        $this->amount = $amount;
    }

    /**
     * Set the value of Installments
     *
     * @param int $installments
     *
     * @throws Se a parcela não for inteiro ou ter mais que 2 caracteres
     */
    public function setInstallments($installments)
    {
        if (!is_int($installments) || strlen($installments) < 1 || strlen($installments) > 2) {
            throw new \UnexpectedValueException(
                'Se as parcelas não forem do tipo inteiro ou tiverem mais que 2 caracteres'
            );
        }
        $this->installments = $installments;
    }
}
