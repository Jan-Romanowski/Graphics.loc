<?php

class Queries{


	/**
	 * @param $email
	 * @return bool
	 */
	public static function isQueryExist($email)
	{
		$db = Db::getConnection();

		$result = $db->prepare("SELECT COUNT(*) as cnt
										FROM queries
										WHERE email = :email");

		$result->bindParam(':email', $email, PDO::PARAM_STR);

		$result->execute();

		if ($result->fetchColumn() == 1)
			return true;

		else
			return false;
	}


	/**
	 * @param $name
	 * @param $surname
	 * @param $email
	 * @param $pass
	 * @return bool
	 */
	public static function register($name, $surname, $email, $pass){

		$db = Db::getConnection();

		$sql = 'INSERT INTO queries (name, surname, email, password)'
			. 'VALUES (:name, :surname, :email, MD5(:ac_password))';

		$result = $db->prepare($sql);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->bindParam(':name', $name, PDO::PARAM_STR);
		$result->bindParam(':surname', $surname, PDO::PARAM_STR);
		$result->bindParam(':ac_password', $pass, PDO::PARAM_STR);

		return $result->execute();


	}

}
