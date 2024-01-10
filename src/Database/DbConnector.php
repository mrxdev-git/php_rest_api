<?php

namespace DataEx\Database;

use PDO;
use PDOException;
use Exception;

class DbConnector
{
	protected static $connection;

	private $host = 'localhost';
	private $db   = 'admin_eltorg';
	private $user = 'admin_eltorg';
	private $password = 'FIz6IL4LBOyaeTZ3dRgS';

	private function __construct(){}

	public function connect()
	{
		try {
			$conn = new PDO(
				   'mysql:host=' . $this->host . ';dbname=' . $this->db . ';charset=utf8',
				   $this->user,
				   $this->password,
				   [
						  PDO::ATTR_PERSISTENT => true,
						  PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
				   ]
			);

			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			throw new Exception($e->getMessage(), $e->getCode(), $e);
		}

		return $conn;
	}

	public static function getConnection()
	{
		if (!isset(self::$connection)){
			$conn = new static();
			self::$connection = $conn->connect();
		}

		return self::$connection;
	}

}