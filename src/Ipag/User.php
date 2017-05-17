<?php namespace Ipag;

class User
{
    /**
     * @var string
     */
    private $identification;

    /**
     * @var string
     */
    private $identification2;

    /**
     * @param string $identification
     *
     * @return self
     */
    function __construct($identification)
    {
        $this->setIdentification($identification);

        return $this;
    }

    /**
     * Get the value of Identification
     *
     * @return string
     */
    public function getIdentification()
    {
        return $this->identification;
    }

    /**
     * Set the value of Identification
     *
     * @param string $identification
     *
     * @return self
     */
    public function setIdentification($identification)
    {
        $this->identification = $identification;

        return $this;
    }

    /**
     * Gets the value of identification2.
     *
     * @return string
     */
    public function getIdentification2()
    {
        return $this->identification2;
    }

    /**
     * Sets the value of identification2.
     *
     * @param string $identification2 the identification2
     *
     * @return self
     */
    public function setIdentification2($identification2)
    {
        $this->identification2 = $identification2;

        return $this;
    }
}
