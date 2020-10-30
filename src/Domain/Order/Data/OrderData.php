<?php

namespace App\Domain\Order\Data;

final class OrderData
{

    /**
     * Order ID
     *
     * @var int
     */
    public $id;

    /**
     * Order timeCreated
     *
     * @var string
     */
    public $timeCreated;
    
    /**
    * Order employeeId
    *
    * @var int
    */
    public $employeeId;
    
    /**
    * Order skuId
    *
    * @var int
    */
    public $skuId;
    
    /**
    * Order quantity
    *
    * @var int
    */
    public $quantity;
    
    /**
    * Order totalPrice
    *
    * @var string
    */
    public $totalPrice;
    
    /**
    * Order paidInBox
    *
    * @var int
    */
    public $paidInBox;
    
    /**
     * getter for Order ID
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * setter for Order ID
     *
     * @param int $id
     *
     * @return void
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * getter for Order timeCreated
     *
     * @return string
     */
    public function getTimeCreated()
    {
        return $this->timeCreated;
    }

    /**
     * setter for Order timeCreated
     *
     * @param string $timeCreated
     *
     * @return void
     */
    public function setTimeCreated(string $timeCreated)
    {
        $this->timeCreated = $timeCreated;
    }
    
    /**
     * getter for Order employeeId
     *
     * @return int
     */
    public function getEmployeeId()
    {
        return $this->employeeId;
    }

    /**
     * setter for Order employeeId
     *
     * @param int $employeeId
     *
     * @return void
     */
    public function setEmployeeId(int $employeeId)
    {
        $this->employeeId = $employeeId;
    }
    
    /**
     * getter for Order skuId
     *
     * @return int
     */
    public function getSkuId()
    {
        return $this->skuId;
    }

    /**
     * setter for Order skuId
     *
     * @param int $skuId
     *
     * @return void
     */
    public function setSkuId(int $skuId)
    {
        $this->skuId = $skuId;
    }
    
    /**
     * getter for Order quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * setter for Order quantity
     *
     * @param int $quantity
     *
     * @return void
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }
    
    /**
     * getter for Order totalPrice
     *
     * @return int
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * setter for Order totalPrice
     *
     * @param int $totalPrice
     *
     * @return void
     */
    public function setTotalPrice(int $totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }
    
    /**
     * getter for Order paidInBox
     *
     * @return int
     */
    public function getPaidInBox()
    {
        return $this->paidInBox;
    }

    /**
     * setter for Order paidInBox
     *
     * @param int $paidInBox
     *
     * @return void
     */
    public function setPaidInBox($paidInBox)
    {
        $this->paidInBox = $paidInBox;
    }
}
