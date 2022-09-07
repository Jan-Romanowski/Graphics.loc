<?php

class User{

	/**
	 * @param $name
	 * @return bool
	 */
	public static function checkName($name)
	{
		if (strlen($name) >= 3) {
			return true;
		}
		return false;
	}

	/**
	 * @param $surname
	 * @return bool
	 */
	public static function chekSurname($surname)
	{
		if (strlen($surname) >= 3) {
			return true;
		}
		return false;
	}

	/**
	 * @param $email
	 * @return bool
	 */
	public static function chekEmail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true;
		}
		return false;
	}

	/**
	 * @param $pass1
	 * @param $pass2
	 * @return bool
	 */
	public static function chekPasswords($pass1, $pass2)
	{
		if (strcasecmp($pass1, $pass2) == 0) {
			return true;
		}
		return false;
	}

	/**
	 * @param $pass1
	 * @return bool
	 */
	public static function chekPassword($pass1)
	{
		/*if(strlen($pass1)>=6 && ){
				return true;
		}
		return false; */

		$errors = false;

		if (strlen($pass1) < 8) {
			$errors[] = "Password too short!";
		}

		if (!preg_match("#[0-9]+#", $pass1)) {
			$errors[] = "Password must include at least one number!";
		}

		if (!preg_match("#[a-zA-Z]+#", $pass1)) {
			$errors[] = "Password must include at least one letter!";
		}

		if ($errors) {
			return false;
		}
		return true;
	}

	/**
	 * @param $email
	 * @return bool
	 */
	public static function checkEmailExists($email)
	{

		if (isset($_SESSION["email"])) {
			if (strcmp($email, $_SESSION["email"]) == 0)
				return false;
		}

		$db = Db::getConnection();

		$result = $db->query("SELECT COUNT(*) FROM accounts 
                WHERE email = '$email'");

		$result->setFetchMode(PDO::FETCH_ASSOC);

		$row = $result->fetch();

		if ($row == 1)
			return true;
		else {
			return false;
		}
	}

	/**
	 * @param $userData
	 */
	public static function auth($userData)
	{
		$_SESSION['id'] = $userData['id'];
		$_SESSION['name'] = $userData['name'];
		$_SESSION['surname'] = $userData['surname'];
		$_SESSION['email'] = $userData['email'];
		$_SESSION['rank'] = $userData['rank'];
	}


	/**
	 * @param $email
	 * @param $pass
	 * @return array|false
	 */
	public static function checkUserData($email, $pass)
	{
		$db = Db::getConnection();

		$userData = array();

		$SQL = "SELECT * FROM accounts 
                WHERE email = '$email'
                AND password = MD5('$pass')";
		$result = $db->query($SQL);

		$result->setFetchMode(PDO::FETCH_ASSOC);

		while ($row = $result->fetch()) {
			$userData['id'] = $row['id'];
			$userData['name'] = $row['name'];
			$userData['surname'] = $row['surname'];
			$userData['email'] = $row['email'];
			$userData['rank'] = $row['rank'];
		}

		if ($userData) {
			return $userData;
		}

		return false;
	}


	/**
	 * @param $id
	 * @return bool
	 */
	public static function refreshOnline($id){

		$db = Db::getConnection();

		$now = date("Y-m-d H:i:s");

		$sql = "UPDATE accounts 
            SET 
                last_online = '$now'
            WHERE id = '$id'";

		$result = $db->prepare($sql);

		return $result->execute();

	}


	public static function getUsers($word){

		$db = Db::getConnection();

		$userList = array();

		$result = $db->query("SELECT id, email, name, surname, rank, last_online, regist_date, position
																	  FROM accounts 
																		WHERE (name LIKE '%" . $word . "%' OR surname LIKE '%" . $word . "%' OR email LIKE '%" . $word . "%')
                             ");

		$result->setFetchMode(PDO::FETCH_ASSOC);

		$i = 0;
		while ($row = $result->fetch()) {
			$userList[$i]['id'] = $row['id'];
			$userList[$i]['email'] = $row['email'];
			$userList[$i]['name'] = $row['name'];
			$userList[$i]['surname'] = $row['surname'];
			$userList[$i]['rank'] = $row['rank'];
			$userList[$i]['last_online'] = $row['last_online'];
			$userList[$i]['regist_date'] = $row['regist_date'];
			$userList[$i]['position'] = $row['position'];

			$i++;
		}

		return $userList;

	}

	/**
	 * Проверяем залогинен ли пользователь и возвращаем true/false
	 * @return bool
	 */
	public static function isLogin(){

		if (isset($_SESSION['id']) || isset($_SESSION['rank'])) {
			return true;
		}
		return false;

	}

	/**
	 * Проверяем залогинен ли пользователь, является ли он юзером и возвращаем true/false
	 * @return bool
	 */
	public static function isUser()
	{
		if (self::isLogin()) {
			if (strcasecmp($_SESSION['rank'], "user") == 0)
				return true;
		}
		return false;
	}

	/**
	 * Проверяем залогинен ли пользователь, является ли он админом и возвращаем true/false
	 * @return bool
	 */
	public static function isAdmin()
	{
		if (self::isLogin()) {
			if (strcasecmp($_SESSION['rank'], "admin") == 0)
				return true;
		}
		return false;
	}


	/**
	 * Проверяем, владеет ли пользователь указанными правами. Если нет, то смертная казнь..
	 * @param $rank
	 * @return bool|void
	 */
	public static function checkRoot($rank){

		switch ($rank){
			case 'user':
				if(self::isLogin())
					return true;
				break;
			case 'admin':
				if(self::isAdmin())
					return true;
				break;
			default:
		}

		die('Nie masz uprawnień');

	}

}
