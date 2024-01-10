<?php

namespace DataEx\Database;

use PDO;
use PDOException;
use Exception;

class DbConnector
{
	private $host = 'localhost';
	private $db   = 'admin_eltorg';
	private $user = 'admin_eltorg';
	private $password = 'FIz6IL4LBOyaeTZ3dRgS';

	protected $conn = null;

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