<?php namespace Ipag;

class Product
{
    /**
     * @var stirng
     */
    private $name;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var double
     */
    private $unitPrice;

    /**
     * @var string
     */
    private $sku;

    public function __construct($name, $quantity, $unitPrice, $sku = null)
    {
        $this->setName((string) $name);
        $this->setQuantity($quantity);
        $this->setUnitPrice($unitPrice);
        is_null($sku) ?: $this->setSku((string) $sku);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = substr($name, 0, 100);

        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     *
     * @return self
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return double
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * @param double $unitPrice
     *
     * @return self
     */
    public function setUnitPrice($unitPrice)
    {
        $amount = (double) number_format(str_replace(",", ".", $unitPrice), 2, ".", "");

        $this->unitPrice = $amount;

        return $this;
    }

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     *
     * @return self
     */
    public function setSku($sku)
    {
        $this->sku = substr($sku, 0, 20);

        return $this;
    }
}
