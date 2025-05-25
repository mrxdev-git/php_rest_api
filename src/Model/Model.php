<?php

namespace DataEx\Model;

use DataEx\Database\DbConnector;
use PDO;

abstract class Model
{
	/**
	 * @var PDO|null the database connection
	 */
	protected $conn = null;

	/**
	 * @var string the name of the table
	 */
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
				" . ($offset !== false ? "LIMIT :offset,:limit" : "");

		$params = [];
		if ($offset !== false) {
			$params['i:offset'] = $offset;
			$params['i:limit'] = $limit;
		}

		return $this->query($sql, $params);
	}

	public function query($sql, $params = [])
	{
		$stmt = $this->conn->prepare($sql);

		if ($params){
			$this->bindParams($stmt, $params);
		}

		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	protected function bindParams($stmt, $params)
	{
		foreach ($params as $key => $value){
			$_key = explode(':', $key);

			$type = PDO::PARAM_STR;
			if (count($_key) === 2){
				switch ($_key[0]){
					case 'i':
						$type = PDO::PARAM_INT;
						break;
				}
			}

			$key = end($_key);
			$stmt->bindValue($key, $value, $type);
		}
	}
}