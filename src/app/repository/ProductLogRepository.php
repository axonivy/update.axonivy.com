<?php
namespace axonivy\update\repository;

use PDO;
use axonivy\update\model\ProductLogRecord;

class ProductLogRepository
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
	
	public function write(ProductLogRecord $record): void
	{
		$stmt = $this->pdo->prepare('INSERT INTO ProductLog (
			`Timestamp`,
            HttpRequestIpAddress,
			Product,
			`Version`,
			`Usage`
		) VALUES (
			:Timestamp,
            :HttpRequestIpAddress,
			:Product,
			:Version,
			:Usage
		)');
		
		$stmt->bindValue(':Timestamp', date('Y-m-d H:i:s', $record->getTimestamp()));
		$stmt->bindValue(':HttpRequestIpAddress', $record->getIpAddress());
		$stmt->bindValue(':Product', $record->getProduct());
		$stmt->bindValue(':Version', $record->getVersion());
		$stmt->bindValue(':Usage', $record->getUsage());
		$stmt->execute();
	}
}
