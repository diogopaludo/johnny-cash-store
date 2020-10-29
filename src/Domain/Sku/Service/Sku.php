<?php

namespace App\Domain\Sku\Service;

use App\Domain\Sku\Repository\SkuRepository;
use Selective\Validation\Exception\ValidationException;
use Selective\Validation\ValidationResult;

/**
 * Service.
 */
final class Sku
{
    /**
     * @var SkuRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param SkuRepository $repository The repository
     */
    public function __construct(SkuRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * get the information of a SKU.
     *
     * @param int $id The ID requested
     *
     * @return array The data acquired
     */
    public function getSku(int $id): array
    {
        $this->validateId($id);

        $data = $this->repository->getSku($id);
        return $data;
    }
    
    /**
     * get a list of the top selling SKU.
     *
     * @return array The data acquired
     */
    public function getTopSelling($initialDate, $finalDate): array
    {
        $this->validatePeriod($initialDate, $finalDate);

        $data = $this->repository->getTopSelling($initialDate, $finalDate);
        return $data;
    }
    
    /**
     * ID validation.
     *
     * @param int $id The id parameter
     *
     * @throws ValidationException
     *
     * @return void
     */
    private function validateId(int $id): void
    {
        $errors = [];
        if (empty($id)) {
            $errors['id'] = 'ID required';
        }
        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }
    
    /**
     * Date validation.
     *
     * @param string $data data
     *
     * @throws ValidationException
     *
     * @return void
     */
    private function validatePeriod($initialDate, $finalDate): void
    {
        $format = 'Y-m-d';
        $validationResult = new ValidationResult();

        $date = \DateTime::createFromFormat($format, $initialDate);
        if (!$date || $date->format($format) != $initialDate) {
            $validationResult->addError('initialDate', 'Initial date invalid.');
        }
        $date = \DateTime::createFromFormat($format, $finalDate);
        if (!$date || $date->format($format) != $finalDate) {
            $validationResult->addError('finalDate', 'Final date invalid.');
        }
        if ($finalDate < $initialDate) {
            $validationResult->addError('initialDate', 'Initial date is bigger than the final date.');
        }
        if ($validationResult->fails()) {
            throw new ValidationException('Please check your input', $validationResult);
        }
    }
}
