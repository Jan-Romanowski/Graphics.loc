<?php

class Db{
	public static function getConnection(){
		$paramsPath = ROOT . '/config/db_params.php';
		$params = include($paramsPath);

		try {
			$dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
			$db = new PDO($dsn, $params['user'], $params['password'],
				array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		} catch (PDOException $e) {
			echo("Can't open the database.");
		}

		return $db;
	}
}



