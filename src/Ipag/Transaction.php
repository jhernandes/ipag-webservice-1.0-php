<?php namespace Ipag;

class Transaction
{
    /**
     * @var Order
     */
    private $order;

    /**
     * @var Payment
     */
    private $payment;

    /**
     * @var Customer
     */
    private $customer;

    /**
     * @var User
     */
    private $user;

    /**
     * @var Subscription
     */
    private $subscription;

    /**
     * @var string
     */
    private $tid;

    /**
     * @param Order $order
     * @param null|Payment $payment
     * @param null|Customer $customer
     *
     * @return self
     */
    function __construct(User $user, Order $order, Payment $payment = null, Customer $customer = null)
    {
        $this->setUser($user);
        $this->setOrder($order);
        is_null($payment)?:$this->setPayment($payment);
        is_null($customer)?:$this->setCustomer($customer);

        return $this;
    }

    /**
     * Get the value of Order
     *
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Get the value of Payment
     *
     * @return Payment
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Get the value of Customer
     *
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set the value of Order
     *
     * @param Order $order
     *
     * @return self
     */
    public function setOrder(Order $order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Set the value of Payment
     *
     * @param Payment $payment
     *
     * @return self
     */
    public function setPayment(Payment $payment)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * Set the value of Customer
     *
     * @param Customer $customer
     *
     * @return self
     */
    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get the value of User
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of User
     *
     * @param User user
     *
     * @return self
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Gets the value of subscription.
     *
     * @return Subscription
     */
    public function getSubscription()
    {
        return $this->subscription;
    }

    /**
     * Sets the value of subscription.
     *
     * @param Subscription $subscription the subscription
     *
     * @return self
     */
    public function setSubscription(Subscription $subscription)
    {
        $this->subscription = $subscription;

        return $this;
    }

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
}
