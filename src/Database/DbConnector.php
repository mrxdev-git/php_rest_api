<?php

namespace DataEx\Database;

use PDO;
use PDOException;
use Exception;

class DbConnector
{
	private string $host = '127.0.0.1';
	private string $db   = 'wa';
	private string $user = 'root';
	private string $password = 'root';

	protected ?PDO $conn = null;

	public function connect()
	{
		try {
			$this->conn = new PDO(
				   'mysql:host=' . $this->host . ';dbname=' . $this->db,
				   $this->user,
				   $this->password,
				   [
						  PDO::ATTR_PERSISTENT => true
				   ]
			);

			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			throw new Exception($e->getMessage(), $e->getCode(), $e);
		}

		return $this->conn;
	}
}