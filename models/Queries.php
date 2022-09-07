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


	/**
	 * @return mixed
	 */
	public static function getCountQueries()
	{
		$db = Db::getConnection();

		$result = $db->query("SELECT count(*) as kek
                                        FROM queries");

		$result->setFetchMode(PDO::FETCH_ASSOC);
		$row = $result->fetch();

		return $row['kek'];
	}

	/**
	 * @param $id
	 * @return bool
	 */
	public static function deleteQuery($id)
	{
		$db = Db::getConnection();

		$sql = "DELETE FROM queries
                 WHERE id = '$id'";

		$result = $db->prepare($sql);

		return $result->execute();
	}


	public static function transferQuery($id, $rank, $position)
	{
		$db = Db::getConnection();

		$result = $db->query("SELECT email, name, surname, password FROM queries WHERE id = '$id';");

		$result->setFetchMode(PDO::FETCH_ASSOC);

		$row = $result->fetch();
		$email = $row["email"];
		$pas = $row["password"];
		$name = $row["name"];
		$surname = $row["surname"];

		$sql = "INSERT INTO accounts(email, name, surname, password, rank, position)
                values('$email', '$name', '$surname','$pas', '$rank', '$position');";

		$result1 = $db->query($sql);

		$sql = "DELETE FROM queries WHERE id = '$id'";

		$result2 = $db->query($sql);

		if ($result1 && $result2) {
			return true;
		} else {
			return false;
		}
	}


	public static function getQueries()
	{
		$db = Db::getConnection();

		$queriesList = array();

		$result = $db->query("SELECT id, email, name, surname, regist_date
                                        FROM queries; 
                             ");

		$result->setFetchMode(PDO::FETCH_ASSOC);

		$i = 0;
		while ($row = $result->fetch()) {
			$queriesList[$i]['id'] = $row['id'];
			$queriesList[$i]['email'] = $row['email'];
			$queriesList[$i]['name'] = $row['name'];
			$queriesList[$i]['surname'] = $row['surname'];
			$queriesList[$i]['regist_date'] = $row['regist_date'];

			$i++;
		}

		return $queriesList;
	}


	public static function getQueryById($id){
		$id = intval($id);

		if ($id) {

			$db = Db::getConnection();

			$result = $db->query('
            SELECT email, name
            FROM queries 
            WHERE id = ' . $id);
			$result->setFetchMode(PDO::FETCH_ASSOC);

			$query = $result->fetch();

			return $query;
		}
	}



}
