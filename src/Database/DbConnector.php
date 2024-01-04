<?php

namespace DataEx\Database;

use PDO;
use PDOException;
use Exception;

class DbConnector
{
	private string $host = 'localhost';
	private string $db   = 'apidb';
	private string $user = '';
	private string $password = '';

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