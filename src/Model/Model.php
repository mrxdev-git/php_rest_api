<?php

namespace DataEx\Model;

use DataEx\Database\DbConnector;
use PDO;

abstract class Model
{
	protected ?PDO $conn = null;
	protected string $table;

	public function __construct()
	{
		$db = new DbConnector();
		$this->conn = $db->connect();
	}

	public function getAll($offset = 0, $limit = 100)
	{
		$sql = "SELECT * FROM `{$this->table}` LIMIT ?,?";
		$statement = $this->conn->prepare($sql);

		$statement->bindParam(1, $offset);
		$statement->bindParam(2, $limit);
		$statement->execute();
	}
}