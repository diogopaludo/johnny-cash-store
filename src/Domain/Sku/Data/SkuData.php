<?php

namespace App\Domain\Sku\Data;

final class SkuData
{

    /**
     * SKU ID
     *
     * @var int
     */
    public $id;

    /**
     * SKU name
     *
     * @var string
     */
    public $name;
    
    /**
     * SKU price
     *
     * @var int
     */
    public $price;

    /**
     * getter for SKU ID
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * setter for SKU ID
     *
     * @param int $id
     *
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * getter for SKU name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * setter for SKU name
     *
     * @param int $name
     *
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    
    /**
     * getter for SKU price
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * setter for SKU price
     *
     * @param int $price
     *
     * @return void
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }
}
