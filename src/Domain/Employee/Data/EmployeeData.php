<?php

namespace App\Domain\Employee\Data;

final class EmployeeData
{

    /**
     * Employee ID
     *
     * @var int
     */
    public $id;

    /**
     * Employee name
     *
     * @var string
     */
    public $name;
    
    /**
     * getter for Employee ID
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * setter for Employee ID
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
     * getter for Employee name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * setter for Employee name
     *
     * @param int $name
     *
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
