<?php

namespace App\Domain\Order\Service;

use App\Domain\Order\Data\OrderData;
use App\Domain\Order\Repository\OrderRepository;
use Selective\Validation\Exception\ValidationException;
use Selective\Validation\ValidationResult;

/**
 * Service.
 */
final class Order
{
    /**
     * @var OrderRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param OrderRepository $repository The repository
     */
    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * get the information of an order.
     *
     * @param int $id The ID requested
     *
     * @return OrderData The data acquired
     */
    public function getOrder(int $id): OrderData
    {
        return $this->repository->getOrder($id);
    }
    
    /**
     * get the information of an order.
     *
     * @return array The data acquired
     */
    public function getUnpaidBills(): array
    {
        return $this->repository->getUnpaidBills();
    }
}
