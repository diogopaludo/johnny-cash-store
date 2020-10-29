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
    
    /**
     * Get employee row.
     *
     * @param int $id The ID requested
     *
     * @return array The order information
     */
    public function getUnpaidBills(int $id): array
    {
        $sql =
        "	SELECT OrderLog.*
			FROM `johnnyorderlog` AS OrderLog 
			LEFT JOIN `johnnypaymentlog` AS PaymentLog ON PaymentLog.id = OrderLog.paidInBox 
			WHERE 
				OrderLog.employeeId = '$id'
				AND ( 
					OrderLog.paidInBox IS NULL OR ( 
						OrderLog.paidInBox IS NOT NULL 
						AND PaymentLog.amount != OrderLog.totalPrice
					)
				)
		";
        
        $stm = $this->connection->prepare($sql);
        $stm->execute();
        $result = [];
        while ($res = $stm->fetchObject()) {
            $result[] = (array)$res;
        }
        return $result;
    }
}
