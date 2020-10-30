<?php

namespace App\Domain\Order\Repository;

use PDO;
use App\Domain\Order\Data\OrderData;

/**
 * Repository.
 */
class OrderRepository
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
     * Get order row.
     *
     * @param int $id The order ID
     *
     * @return OrderData The order information
     */
    public function getOrder(int $id): OrderData
    {
        $sql =
        "	SELECT 
				`id`, 
				`time_created`, 
				`employeeId`, 
				`skuId`, 
				`quantity`, 
				`totalPrice`, 
				`paidInBox` 
			FROM `johnnyorderlog` 
			WHERE `id` = '$id'
		";
        
        $stm = $this->connection->prepare($sql);
        $stm->execute();

        $order = new OrderData;
        if ($result = $stm->fetchObject()) {
            $order->setId($result->id);
            $order->setTimeCreated($result->time_created);
            $order->setEmployeeId($result->employeeId);
            $order->setSkuId($result->skuId);
            $order->setQuantity($result->quantity);
            $order->setTotalPrice($result->totalPrice);
            $order->setPaidInBox($result->paidInBox);
        }
        return $order;
    }
    
    /**
     * Get order row.
     *
     * @param int $id The ID requested
     *
     * @return array The order information
     */
    public function getUnpaidBills(): array
    {
        $sql =
        "	SELECT OrderLog.*
			FROM `johnnyorderlog` AS OrderLog 
			LEFT JOIN `johnnypaymentlog` AS PaymentLog ON PaymentLog.id = OrderLog.paidInBox 
			WHERE 
				OrderLog.paidInBox IS NULL OR ( 
					OrderLog.paidInBox IS NOT NULL 
					AND PaymentLog.amount != OrderLog.totalPrice
				)
			ORDER BY OrderLog.time_created
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
