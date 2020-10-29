<?php

namespace App\Domain\Employee\Repository;

use PDO;

/**
 * Repository.
 */
class EmployeeGetterRepository
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
     * Insert employee row.
     *
     * @param int $id The employee ID
     *
     * @return array The employee information
     */
    public function getEmployee(int $id): array
    {
        $sql = "SELECT `id`, `name` FROM `johnnyemployee` WHERE id = '$id'";
        
        $stm = $this->connection->prepare($sql);
        $stm->execute();

        return (array)$stm->fetchObject();
    }
}
