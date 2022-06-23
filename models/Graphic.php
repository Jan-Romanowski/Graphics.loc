<?php

class Graphic{

	/**
	 * @param $date
	 * @return bool
	 */
	public static function isDayExist($date){

		$db = Db::getConnection();

		$sql = 'SELECT COUNT(*) 
						FROM users_graphic 
						WHERE date = :date 
						AND user = :id';

		$result = $db->prepare($sql);
		$result->bindParam(':date', $date, PDO::PARAM_STR);
		$result->bindParam(':id', $_SESSION['id'], PDO::PARAM_STR);
		$result->execute();

		if ($result->fetchColumn())
			return true;

		return false;

	}


	/**
	 * @param $user
	 * @param $date
	 * @param $position
	 * @param $from
	 * @param $to
	 * @param $notes
	 * @return bool
	 */
	public static function addDay($user, $date, $position, $from, $to, $notes){

		$db = Db::getConnection();

		$sql = 'INSERT INTO users_graphic (user, date, position, time_from, time_to, notes)'
			   . 'VALUES (:user, :date, :position, :from, :to, :notes)';

		$result = $db->prepare($sql);
		$result->bindParam(':user', $user, PDO::PARAM_INT);
		$result->bindParam(':date', $date, PDO::PARAM_STR);
		$result->bindParam(':position', $position, PDO::PARAM_STR);
		$result->bindParam(':from', $from, PDO::PARAM_STR);
		$result->bindParam(':to', $to, PDO::PARAM_STR);
		$result->bindParam(':notes', $notes, PDO::PARAM_STR);

		return $result->execute();

	}


	/**
	 * @param $date
	 * @param $id
	 * @return bool
	 */
	public static function deleteUserDay($date, $id)
	{

		echo $date.' . '.$id;

		$db = Db::getConnection();

		$sql = "DELETE FROM users_graphic
            WHERE user = '$id'
            AND date = '$date'";

		$result = $db->prepare($sql);

		return $result->execute();
	}




}
