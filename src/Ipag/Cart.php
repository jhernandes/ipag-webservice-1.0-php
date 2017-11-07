<?php namespace Ipag;

use Ipag\Product;

class Cart
{
    /**
     * @var array of Product
     */
    private $products;

    /**
     * @return array of Product
     */
    public function getProducts()
    {
        if (empty($this->products)) {
            return array();
        }
        return $this->products;
    }

    /**
     * @param Product $product
     *
     * @return self
     */
    public function addProduct(Product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * @param array of Product $products
     *
     * @return self
     */
    public function addProducts(array $products)
    {
        foreach ($products as $product) {
            $this->addProduct($product);
        }

        return $this;
    }

}
