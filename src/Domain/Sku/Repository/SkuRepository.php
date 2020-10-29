<?php

namespace App\Domain\Sku\Repository;

use PDO;

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
     * get SKU row.
     *
     * @param int $id The SKU ID
     *
     * @return array The SKU information
     */
    public function getSku(int $id): array
    {
        $sql = "SELECT `id`, `name`, `price` FROM `johnnysku` WHERE id = '$id'";
        
        $stm = $this->connection->prepare($sql);
        $stm->execute();

        return (array)$stm->fetchObject();
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
