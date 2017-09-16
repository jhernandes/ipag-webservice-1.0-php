<?php namespace Ipag;

class Address
{
    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $number;

    /**
     * @var string
     */
    private $complement;

    /**
     * @var string
     */
    private $neighborhood;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $state;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $zipCode;

    /**
     * @param string $street
     * @param int $number
     * @param string $complement
     * @param strin $zipCode
     * @param string $city
     * @param string $state
     * @param string $country
     *
     * @return self
     */
    public function __construct(
        $street,
        $number,
        $neighborhood,
        $complement,
        $zipCode,
        $city,
        $state,
        $country = 'BR'
    ) {
        $this->setStreet((string) $street);
        $this->setNumber((int) $number);
        $this->setNeighborhood((string) $neighborhood);
        empty($complement) ?: $this->setComplement((string) $complement);
        $this->setZipCode((string) $zipCode);
        $this->setCity((string) $city);
        $this->setState((string) $state);
        $this->setCountry((string) $country);

        return $this;
    }

    /**
     * Get the value of Street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
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
     * Get the value of Complement
     *
     * @return string
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * Get the value of Neighboorhood
     *
     * @return string
     */
    public function getNeighborhood()
    {
        return $this->neighborhood;
    }

    /**
     * Get the value of City
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Get the value of State
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Get the value of Country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Get the value of Zip Code
     *
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set the value of Street
     *
     * @param string street
     * @throws \UnexpectedValueException se o nome da rua não for string ou
     * conter de 1 à 100 caracteres
     *
     * @return self
     */
    public function setStreet($street)
    {
        if (!empty($street) && (!is_string($street))) {
            throw new \UnexpectedValueException(
                'O nome da rua deve ser string'
            );
        }
        $this->street = substr($street, 0, 100);

        return $this;
    }

    /**
     * Set the value of Number
     *
     * @param string number
     * @throws \UnexpectedValueException se o numero da casa não for um numero ou conter de 1 à 5 caracteres
     *
     * @return self
     */
    public function setNumber($number)
    {
        if (!empty($number) && !is_numeric($number)) {
            throw new \UnexpectedValueException(
                'O número do endereço deve ser numérico'
            );
        }
        $this->number = substr($number, 0, 15);

        return $this;
    }

    /**
     * Set the value of Complement
     *
     * @param string complement
     * @throws \UnexpectedValueException se o complemento não for string ou conter de 1 à 50 caracteres
     *
     * @return self
     */
    public function setComplement($complement)
    {
        if (!empty($complement) && !is_string($complement)) {
            throw new \UnexpectedValueException(
                'O complemento do endereço deve ser string'
            );
        }
        $this->complement = substr($complement, 0, 255);

        return $this;
    }

    /**
     * Set the value of Neighborhood
     *
     * @param string neighborhood
     * @throws \UnexpectedValueException se o bairro não for string ou conter de 1 à 20 caracteres
     *
     * @return self
     */
    public function setNeighborhood($neighborhood)
    {
        if (!empty($neighborhood) && !is_string($neighborhood)) {
            throw new \UnexpectedValueException(
                'O bairro do endereço deve ser string'
            );
        }
        $this->neighborhood = substr($neighborhood, 0, 40);

        return $this;
    }

    /**
     * Set the value of City
     *
     * @param string city
     * @throws \UnexpectedValueException se a cidade não for string ou conter de 1 à 20 caracteres
     *
     * @return self
     */
    public function setCity($city)
    {
        if (!empty($city) && !is_string($city)) {
            throw new \UnexpectedValueException(
                'A cidade deve ser string'
            );
        }
        $this->city = substr($city, 0, 40);

        return $this;
    }

    /**
     * Set the value of State
     *
     * @param string state
     * @throws \UnexpectedValueException se a cidade não for string ou ter menos ou mais que 2 caracteres
     *
     * @return self
     */
    public function setState($state)
    {
        if (!empty($state) && (!is_string($state) || strlen($state) != 2)) {
            throw new \UnexpectedValueException(
                'O estado deve ser string e ter 2 caracteres'
            );
        }
        $this->state = $state;

        return $this;
    }

    /**
     * Set the value of Country
     *
     * @param string country
     * @throws \UnexpectedValueException se o pais não for string
     *
     * @return self
     */
    public function setCountry($country)
    {
        if (!empty($country) && !is_string($country)) {
            throw new \UnexpectedValueException(
                'O país deve ser string'
            );
        }
        $this->country = $country;

        return $this;
    }

    /**
     * Set the value of Zip Code
     *
     * @param string zipCode
     * @throws \UnexpectedValueException se o cep não for string ou conter de 1 à 9 caracteres
     *
     * @return self
     */
    public function setZipCode($zipCode)
    {
        if (!empty($zipCode) && !is_string($zipCode)) {
            throw new \UnexpectedValueException(
                'O CEP deve ser string e ter entre 1 e 8 caracteres'
            );
        }
        $this->zipCode = substr(preg_replace('/\D/', '', $zipCode), 0, 8);

        return $this;
    }

}
