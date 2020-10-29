<?php

namespace App\Domain\Employee\Repository;

use PDO;
use App\Domain\Employee\Data\EmployeeData;

/**
 * Repository.
 */
class EmployeeRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;

    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Get employee row.
     *
     * @param int $id The employee ID
     *
     * @return EmployeeData The employee information
     */
    public function getEmployee(int $id): EmployeeData
    {
        $sql = "SELECT `id`, `name` FROM `johnnyemployee` WHERE id = '$id'";
        
        $stm = $this->connection->prepare($sql);
        $stm->execute();

        $result = (array)$stm->fetchObject();

        $employee = new EmployeeData;
        $employee->setId($result['id']);
        $employee->setName($result['name']);

        return $employee;
    }
}
