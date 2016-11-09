<?php namespace Ipag;

use Ipag\Transaction;
use Ipag\Payment;
use Ipag\Customer;
use Ipag\Order;
use Ipag\Address;
use Ipag\Card;
use Ipag\Serializer\PaymentSerializer;
use Ipag\Serializer\ConsultSerializer;
use Ipag\Serializer\CancelSerializer;
use Ipag\Serializer\CaptureSerializer;
use Ipag\Serializer\IpagResponse;
use Ipag\Http\OnlyPostHttpClientInterface;
use Ipag\Http\CurlOnlyPostHttpClient;

class Ipag
{
    /**
     * @var string
     */
    const PRODUCTION = 'https://www.librepag.com.br';

    /**
     * @var string
     */
    const TEST = 'http://core.ipag.dev';

    const PAYMENT = '/pagamento.php';
    const CONSULT = '/consulta';
    const CAPTURE = '/captura';
    const CANCEL = '/cancela';

    /**
     * @var string
     */
    private $identification;

    /**
     * @var string
     */
    private $endpoint;

    /**
     * @var OnlyPostHttpClientInterface
     */
    private $onlyPostClient;

    /**
     * @param string                      $identification
     * @param string                      $endpoint
     * @param OnlyPostHttpClientInterface $onlyPostClient
     */
    function __construct(
        $identification,
        $endpoint = Ipag::PRODUCTION,
        OnlyPostHttpClientInterface $onlyPostClient = null
    ) {
        $this->user           = new User($identification);
        $this->endpoint       = $endpoint;
        $this->onlyPostClient = $onlyPostClient ?: new CurlOnlyPostHttpClient();
    }

    /**
     * @param  Order   $order
     * @param  null|Payment $payment
     * @param  null|Customer  $customer
     * @return Transaction
     */
    public function transaction(Order $order, Payment $payment = null, Customer $customer = null)
    {
        return new Transaction($this->user, $order, $payment, $customer);
    }

    /**
     * @param  string $orderId
     * @param  double $amount
     * @param  int $installments
     * @param  string $operation
     * @param  string $callbackUrl
     * @param  string $returnType
     * @return Order
     */
    public function order(
        $orderId,
        $amount,
        $installments,
        $operation,
        $callbackUrl = Order::RETURN_XML,
        $returnType = Order::RETURN_XML
    ) {
        return new Order($orderId, $amount, $installments, $operation, $callbackUrl, $returnType);
    }

    /**
     * @param  string $method
     * @param  null|Card $card
     * @return Payment
     */
    public function payment($method, $card = null)
    {
        return new Payment($method, $card);
    }

    /**
     * @param  string $name
     * @param  string $email
     * @param  string $identity
     * @param  string $phone
     * @return Customer
     */
    public function customer($name, $email, $identity = null, $phone = null)
    {
        return new Customer($name, $email, $identity, $phone);
    }

    /**
     * @param string $street
     * @param int $number
     * @param string $complement
     * @param strin $zipCode
     * @param string $city
     * @param string $state
     * @param string $country
     */
    public function address(
        $street,
        $number,
        $neighborhood,
        $complement,
        $zipCode,
        $city,
        $state,
        $country = 'BR'
    ) {
        return new Address(
            $street, $number, $neighborhood, $complement,
            $zipCode, $city, $state, $country
        );
    }

    /**
     * @param string      $tokenOrNumber
     * @param null|string $holder
     * @param null|string $expireMonth
     * @param null|string $expireYear
     * @param int         $cvv
     */
    public function card(
        $tokenOrNumber,
        $holder = null,
        $expireMonth = null,
        $expireYear = null,
        $cvv = null
    ) {
        if (func_num_args() == 1) {
            return new Card($tokenOrNumber);
        }
        return new Card($tokenOrNumber, $holder, $expireMonth, $expireYear, $cvv);
    }

    /**
     * @param  array $message
     * @return string
     */
    private function sendHttpRequest($message)
    {
        /* @var callable|OnlyPostHttpClientInterface $sendPostRequest */
        $sendPostRequest = $this->onlyPostClient;

        return $sendPostRequest(
            $this->endpoint,
            [
                'Content-Type' => 'application/x-www-form-urlencoded; charset=utf-8',
            ],
            $message
        );
    }

    /**
     * @param  Transaction $transaction
     * @return IpagResponse
     */
    public function paymentRequest(Transaction $transaction)
    {
        $this->endpoint .= Ipag::PAYMENT;

        $serializer = new PaymentSerializer();
        $response = $this->sendHttpRequest($serializer->serialize($transaction));

        $ipagResponse = new IpagResponse();

        return $ipagResponse->unserialize($response);
    }

    /**
     * @param  Transaction $transaction
     * @return IpagResponse
     */
    public function consultRequest(Transaction $transaction)
    {
        $this->endpoint .= Ipag::CONSULT;

        $serializer = new ConsultSerializer();
        $response = $this->sendHttpRequest($serializer->serialize($transaction));

        $ipagResponse = new IpagResponse();

        return $ipagResponse->unserialize($response);
    }

    /**
     * @param  Transaction $transaction
     * @return IpagResponse
     */
    public function cancelRequest(Transaction $transaction)
    {
        $this->endpoint .= Ipag::CANCEL;

        $serializer = new CancelSerializer();
        $response = $this->sendHttpRequest($serializer->serialize($transaction));

        $ipagResponse = new IpagResponse();

        return $ipagResponse->unserialize($response);
    }

    /**
     * @param  Transaction $transaction
     * @return IpagResponse
     */
    public function captureRequest(Transaction $transaction)
    {
        $this->endpoint .= Ipag::CAPTURE;

        $serializer = new CaptureSerializer();
        $response = $this->sendHttpRequest($serializer->serialize($transaction));

        $ipagResponse = new IpagResponse();

        return $ipagResponse->unserialize($response);
    }

}
