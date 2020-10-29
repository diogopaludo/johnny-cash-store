<?php

namespace App\Domain\Employee\Service;

use App\Domain\Employee\Data\EmployeeData;
use App\Domain\Employee\Repository\EmployeeRepository;
use Selective\Validation\Exception\ValidationException;
use Selective\Validation\ValidationResult;

/**
 * Service.
 */
final class Employee
{
    /**
     * @var EmployeeRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param EmployeeRepository $repository The repository
     */
    public function __construct(EmployeeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * get the information of an employee.
     *
     * @param int $id The ID requested
     *
     * @return EmployeeData The data acquired
     */
    public function getEmployee(int $id): EmployeeData
    {
        return $this->repository->getEmployee($id);
    }
}
