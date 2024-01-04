<?php

namespace DataEx\Database;

class DbConnector
{
	private string $host = 'localhost';
	private string $db   = 'apidb';
	private string $user = '';
	private string $password = '';

	protected \PDO $conn;

	public function connect()
	{
		try {
			$this->conn = new \PDO(
				   'mysql:host=' . $this->host . ';dbname=' . $this->db,
				   $this->user,
				   $this->password,
				   [
						  PDO::ATTR_PERSISTENT => true
				   ]
			);

			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		} catch (\PDOException $e) {
			echo $e->getMessage();
		}

		return $this->conn;
	}
}