<?php namespace Ipag;

class Customer
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $identity;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var Address
     */
    private $address;

    /**
     * @param string $name
     * @param string $email
     * @param null|string $identity
     * @param null|string $phone
     *
     * @return self
     */
    function __construct($name = null, $email = null, $identity = null, $phone = null)
    {
        is_null($name)?:$this->setName((string)$name);
        is_null($email)?:$this->setEmail((string)$email);
        is_null($identity)?:$this->setIdentity((string)$identity);
        is_null($phone)?:$this->setPhone((string)$phone);

        return $this;
    }

    /**
     * Get the value of Name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of Identity
     *
     * @return string
     */
    public function getIdentity()
    {
        return $this->identity;
    }

    /**
     * Get the value of Email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the value of Phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Get the value of Address
     *
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of Name
     *
     * @param string name
     *
     * @throws \UnexpectedValueException se o nome do cliente não for
     * do tipo `string` ou exceder 30 caracteres
     *
     * @return self
     */
    public function setName($name)
    {
        if (!is_string($name) || strlen($name) > 30) {
            throw new \UnexpectedValueException(
                'O nome do cliente deve ser uma string com, no máximo, 30 caracteres'
            );
        }
        $this->name = $name;

        return $this;
    }

    /**
     * Set the value of Identity
     *
     * @param string identity
     *
     * @return self
     */
    public function setIdentity($identity)
    {
        $this->identity = $identity;

        return $this;
    }

    /**
     * Set the value of Email
     *
     * @param string email
     * @throws \UnexpectedValueException se o email não for válido ou string ou não conter
     * de 1 a 100 caracteres
     *
     * @return self
     */
    public function setEmail($email)
    {
        if (!is_string($email) || strlen($email) < 1 || strlen($email) > 100
            || !filter_var($email, FILTER_VALIDATE_EMAIL)
        ) {
            throw new \UnexpectedValueException(
                'O email do cliente deve ser válido e ser string e ter entre 1 e 100 caracteres'
            );
        }
        $this->email = $email;

        return $this;
    }

    /**
     * Set the value of Phone
     *
     * @param string phone
     *
     * @throws \UnexpectedValueException se o número do telefone/celular não é
     * válido ou não tem entre 8 e 15 caracteres
     *
     * @return self
     */
    public function setPhone($phone)
    {
        if (!is_numeric($phone) || strlen($phone) < 8 || strlen($phone) > 15) {
            throw new \UnexpectedValueException(
                'O número do telefone/celular não é válido ou não tem entre 8 e 15 caracteres'
            );
        }
        $this->phone = $phone;

        return $this;
    }

    /**
     * Set the value of Address
     *
     * @param Address address
     *
     * @return self
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;

        return $this;
    }
}
