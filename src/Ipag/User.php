<?php namespace Ipag;

class User
{
    /**
     * @var string
     */
    private $identification;

    /**
     * @param string $identification
     */
    function __construct($identification)
    {
        $this->setIdentification($identification);
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
     */
    public function setIdentification($identification)
    {
        $this->identification = $identification;
    }
}
