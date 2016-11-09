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
        $this->setStreet((string)$street);
        $this->setNumber((int)$number);
        $this->setNeighborhood((string)$neighborhood);
        empty($complement)?:$this->setComplement((string)$complement);
        $this->setZipCode((string)$zipCode);
        $this->setCity((string)$city);
        $this->setState((string)$state);
        $this->setCountry((string)$country);
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
     */
    public function setStreet($street)
    {
        if (!is_string($street) || strlen($street) < 1 || strlen($street) > 100) {
            throw new \UnexpectedValueException(
                'O nome da rua deve ser string e ter entre 1 e 100 caracteres'
            );
        }
        $this->street = $street;
    }

    /**
     * Set the value of Number
     *
     * @param string number
     * @throws \UnexpectedValueException se o numero da casa não for um numero ou conter de 1 à 5 caracteres
     */
    public function setNumber($number)
    {
        if (!is_numeric($number) || strlen($number) < 1 || strlen($number) > 5) {
            throw new \UnexpectedValueException(
                'O número do endereço deve ser numérico e ter entre 1 e 5 caracteres'
            );
        }
        $this->number = $number;
    }

    /**
     * Set the value of Complement
     *
     * @param string complement
     * @throws \UnexpectedValueException se o complemento não for string ou conter de 1 à 50 caracteres
     */
    public function setComplement($complement)
    {
        if (!is_string($complement) || strlen($complement) < 1 || strlen($complement) > 50) {
            throw new \UnexpectedValueException(
                'O complemento do endereço deve ser string e ter entre 1 e 255 caracteres'
            );
        }
        $this->complement = $complement;
    }

    /**
     * Set the value of Neighborhood
     *
     * @param string neighborhood
     * @throws \UnexpectedValueException se o bairro não for string ou conter de 1 à 20 caracteres
     */
    public function setNeighborhood($neighborhood)
    {
        if (!is_string($neighborhood) || strlen($neighborhood) < 1 || strlen($neighborhood) > 20) {
            throw new \UnexpectedValueException(
                'O bairro do endereço deve ser string e ter entre 1 e 20 caracteres'
            );
        }
        $this->neighborhood = $neighborhood;
    }

    /**
     * Set the value of City
     *
     * @param string city
     * @throws \UnexpectedValueException se a cidade não for string ou conter de 1 à 20 caracteres
     */
    public function setCity($city)
    {
        if (!is_string($city) || strlen($city) < 1 || strlen($city) > 20) {
            throw new \UnexpectedValueException(
                'A cidade deve ser string e ter entre 1 e 20 caracteres'
            );
        }
        $this->city = $city;
    }

    /**
     * Set the value of State
     *
     * @param string state
     * @throws \UnexpectedValueException se a cidade não for string ou ter menos ou mais que 2 caracteres
     */
    public function setState($state)
    {
        if (!is_string($state) || strlen($state) != 2) {
            throw new \UnexpectedValueException(
                'O estado deve ser string e ter 2 caracteres'
            );
        }
        $this->state = $state;
    }

    /**
     * Set the value of Country
     *
     * @param string country
     * @throws \UnexpectedValueException se o pais não for string
     */
    public function setCountry($country)
    {
        if (!is_string($country)) {
            throw new \UnexpectedValueException(
                'O país deve ser string'
            );
        }
        $this->country = $country;
    }

    /**
     * Set the value of Zip Code
     *
     * @param string zipCode
     * @throws \UnexpectedValueException se o cep não for string ou conter de 1 à 9 caracteres
     */
    public function setZipCode($zipCode)
    {
        if (!is_string($zipCode) || strlen($zipCode) < 1 || strlen($zipCode) > 9) {
            throw new \UnexpectedValueException(
                'O CEP deve ser string e ter entre 1 e 8 caracteres'
            );
        }
        $this->zipCode = $zipCode;
    }

}
