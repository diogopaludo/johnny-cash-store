<?php

namespace App\Domain\Employee\Service;

use App\Domain\Employee\Repository\EmployeeGetterRepository;
use Selective\Validation\Exception\ValidationException;
use Selective\Validation\ValidationResult;

/**
 * Service.
 */
final class EmployeeGetter
{
    /**
     * @var EmployeeGetterRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param EmployeeGetterRepository $repository The repository
     */
    public function __construct(EmployeeGetterRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * get the information of an employee.
     *
     * @param int $id The ID requested
     *
     * @return array The data acquired
     */
    public function getEmployee(int $id): array
    {
        $this->validateId($id);

        $data = $this->repository->getEmployee($id);
        return $data;
    }

    /**
     * Input validation.
     *
     * @param int $data The form data
     *
     * @throws ValidationException
     *
     * @return void
     */
    private function validateId(int $id): void
    {
        $validationResult = new ValidationResult();
        if (empty($id)) {
            $validationResult->addError('id', 'ID invalid');
        }
        if ($validationResult->fails()) {
            throw new ValidationException('Please check your input', $validationResult);
        }
    }
}
