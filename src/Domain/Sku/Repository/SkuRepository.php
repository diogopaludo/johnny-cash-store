<?php

namespace App\Domain\Sku\Repository;

use PDO;
use App\Domain\Sku\Data\SkuData;

/**
 * Repository.
 */
class SkuRepository
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
     * get SKU row. For simplicity an array can be returned, but an instance of SkuData is being used as a return
     *
     * @param int $id The SKU ID
     *
     * @return SkuData The SKU information
     */
    public function getSku(int $id): SkuData
    {
        $sql = "SELECT `id`, `name`, `price` FROM `johnnysku` WHERE id = '$id'";
        
        $stm = $this->connection->prepare($sql);
        $stm->execute();
        $sku = new SkuData();
        if ($result = $stm->fetchObject()) {
            $sku->setId($result->id);
            $sku->setName($result->name);
            $sku->setPrice($result->price);
        }
        return $sku;
    }
    
    /**
     * get the list of top selling SKU.
     *
     * @return array The SKU List
     */
    public function getTopSelling($initialDate, $finalDate): array
    {
        $sql =
        "	SELECT 
				SKU.id AS skuId,
				SKU.name AS skuName,
				SUM(OrderLog.quantity) AS quantity
			FROM `johnnyorderlog` AS OrderLog
			INNER JOIN `johnnysku` AS SKU ON SKU.id = OrderLog.skuId
			WHERE OrderLog.time_created BETWEEN '$initialDate' AND '$finalDate'
			GROUP BY SKU.id
			ORDER BY quantity DESC
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
