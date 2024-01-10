<?php

namespace DataEx\Model;

use DataEx\Database\DbConnector;
use PDO;

abstract class Model
{
	protected $conn = null;
	protected $table;

	public function __construct()
	{
		$this->conn = DbConnector::getConnection();
	}

	public function getAll($fields = '*', $order_by = null, $offset = 0, $limit = 100)
	{
		$sql = "SELECT {$fields} 
				FROM `{$this->table}`
				" . ($order_by ? "ORDER BY " . $order_by : "") . "
				" . ($offset !== false ? "LIMIT ?,?" : "");

		$statement = $this->conn->prepare($sql);

		if ($offset !== false) {
			$statement->bindValue(1, $offset, PDO::PARAM_INT);
			$statement->bindValue(2, $limit, PDO::PARAM_INT);
		}

		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_COLUMN);
	}
}