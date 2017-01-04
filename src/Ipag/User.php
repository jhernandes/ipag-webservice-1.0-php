<?php namespace Ipag;

class User
{
    /**
     * @var string
     */
    private $identification;

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
}
