<?php

class Graphic{

	/**
	 * @param $date
	 * @return bool
	 */
	public static function isDayExistForUser($date){

		$db = Db::getConnection();

		$sql = 'SELECT COUNT(*) 
				FROM user_graphic 
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

	public static function getDayForUserByDate($date){

		$db = Db::getConnection();

		$dayInfo = array();

		$result = $db->query("SELECT time_from, time_to
							  FROM user_graphic
							  WHERE date = '$date'");

		$result->setFetchMode(PDO::FETCH_ASSOC);

		while ($row = $result->fetch()) {
			$dayInfo[0]['time_from'] = $row['time_from'];
			$dayInfo[1]['time_to'] = $row['time_to'];
		}
		return $dayInfo;

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
	public static function addDay($user, $date, $from, $to, $notes){

		$db = Db::getConnection();

		$sql = 'INSERT INTO user_graphic (user, date, time_from, time_to, notes)'
			   . 'VALUES (:user, :date, :from, :to, :notes)';

		$result = $db->prepare($sql);
		$result->bindParam(':user', $user, PDO::PARAM_INT);
		$result->bindParam(':date', $date, PDO::PARAM_STR);
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
		$db = Db::getConnection();

		$sql = "DELETE FROM user_graphic
            WHERE user = '$id'
            AND date = '$date'";

		$result = $db->prepare($sql);

		return $result->execute();
	}


	public static function isDayExistForAll($date){

		$db = Db::getConnection();

		$result = $db->query("SELECT COUNT(*) as kek
							  FROM user_graphic 
							  WHERE date = '$date'");

		$result->setFetchMode(PDO::FETCH_ASSOC);
		$row = $result->fetch();

		if($row['kek'])
		return $row['kek'];

		return false;

	}

	public static function getDayUsersByDate($date){
		$db = Db::getConnection();

		$dayList = array();

		$result = $db->query("SELECT user_graphic.id, user, date, time_from, time_to, notes, accounts.name, accounts.surname, accounts.position, positions.position pos
							  FROM user_graphic
							  LEFT JOIN accounts ON user_graphic.user = accounts.id
							  LEFT JOIN positions ON accounts.position = positions.id
							  WHERE date = '$date'");

		$result->setFetchMode(PDO::FETCH_ASSOC);

		$i = 0;
		while ($row = $result->fetch()) {
			$dayList[$i]['id'] = $row['id'];
			$dayList[$i]['user'] = $row['user'];
			$dayList[$i]['date'] = $row['date'];
			$dayList[$i]['time_from'] = $row['time_from'];
			$dayList[$i]['time_to'] = $row['time_to'];
			$dayList[$i]['notes'] = $row['notes'];
			$dayList[$i]['name'] = $row['name'];
			$dayList[$i]['surname'] = $row['surname'];
			$dayList[$i]['position'] = $row['pos'];

			$i++;
		}
		return $dayList;

	}

	public static function getDayById($id){

		$db = Db::getConnection();

		$dayList = array();

		$result = $db->query("SELECT user_graphic.id, user, date, time_from, time_to, notes, accounts.name, accounts.surname, accounts.position, positions.position pos
							  FROM user_graphic
							  LEFT JOIN accounts ON user_graphic.user = accounts.id
							  LEFT JOIN positions ON accounts.position = positions.id
							  WHERE user_graphic.id = '$id'");

		$result->setFetchMode(PDO::FETCH_ASSOC);

		$i = 0;
		while ($row = $result->fetch()) {
			$dayList[$i]['id'] = $row['id'];
			$dayList[$i]['user'] = $row['user'];
			$dayList[$i]['date'] = $row['date'];
			$dayList[$i]['time_from'] = $row['time_from'];
			$dayList[$i]['time_to'] = $row['time_to'];
			$dayList[$i]['notes'] = $row['notes'];
			$dayList[$i]['name'] = $row['name'];
			$dayList[$i]['surname'] = $row['surname'];
			$dayList[$i]['position'] = $row['pos'];

			$i++;
		}
		return $dayList;

	}

	public static function transferDayFromUserToFirm($user, $date, $from, $to, $notes){

		$db = Db::getConnection();

		$sql = 'INSERT INTO firm_graphic (user, date, time_from, time_to, notes)'
			   . 'VALUES (:user, :date, :from, :to, :notes)';

		$result = $db->prepare($sql);
		$result->bindParam(':user', $user, PDO::PARAM_INT);
		$result->bindParam(':date', $date, PDO::PARAM_STR);
		$result->bindParam(':from', $from, PDO::PARAM_STR);
		$result->bindParam(':to', $to, PDO::PARAM_STR);
		$result->bindParam(':notes', $notes, PDO::PARAM_STR);

		return $result->execute();


	}

	public static function getDayFirmByDate($date){
		$db = Db::getConnection();

		$dayList = array();

		$result = $db->query("SELECT firm_graphic.id, user, date, time_from, time_to, notes, accounts.name, accounts.surname, accounts.position, positions.position pos
							  FROM firm_graphic
							  LEFT JOIN accounts ON firm_graphic.user = accounts.id
							  LEFT JOIN positions ON accounts.position = positions.id
							  WHERE date = '$date'");

		$result->setFetchMode(PDO::FETCH_ASSOC);

		$i = 0;
		while ($row = $result->fetch()) {
			$dayList[$i]['id'] = $row['id'];
			$dayList[$i]['user'] = $row['user'];
			$dayList[$i]['date'] = $row['date'];
			$dayList[$i]['time_from'] = $row['time_from'];
			$dayList[$i]['time_to'] = $row['time_to'];
			$dayList[$i]['notes'] = $row['notes'];
			$dayList[$i]['name'] = $row['name'];
			$dayList[$i]['surname'] = $row['surname'];
			$dayList[$i]['position'] = $row['pos'];

			$i++;
		}
		return $dayList;

	}

	public static function isGrafikTransferred($idUser, $date){

		$db = Db::getConnection();

		$sql = 'SELECT COUNT(*) 
				FROM firm_graphic 
				WHERE date = :date 
				AND user = :id';

		$result = $db->prepare($sql);
		$result->bindParam(':date', $date, PDO::PARAM_STR);
		$result->bindParam(':id', $idUser, PDO::PARAM_INT);
		$result->execute();

		if ($result->fetchColumn())
			return true;

		return false;	  

	}

	public static function deleteDayForUserFromFirmGraphic($id, $date){

		$db = Db::getConnection();

		$sql = "DELETE FROM firm_graphic
            	WHERE user = '$id'
            	AND date = '$date'";

		$result = $db->prepare($sql);

		return $result->execute();
	
	}

	public static function isDayReady($date){

		$db = Db::getConnection();

		$sql = 'SELECT COUNT(*) 
				FROM firm_graphic 
				WHERE date = :date';

		$result = $db->prepare($sql);
		$result->bindParam(':date', $date, PDO::PARAM_STR);
		$result->execute();

		if ($result->fetchColumn())
			return true;

		return false;	
				
	}

	public static function getReadyDayForUser($userId, $date){

		$db = Db::getConnection();

		$dayInfo = array();

		$result = $db->query("SELECT time_from, time_to
							  FROM firm_graphic
							  WHERE date = '$date'
							  AND user = '$userId'");

		$result->setFetchMode(PDO::FETCH_ASSOC);

		if($result){


			while ($row = $result->fetch()) {
				$dayInfo[0]['time_from'] = $row['time_from'];
				$dayInfo[1]['time_to'] = $row['time_to'];
			}

			return $dayInfo;
		}

		return false;
	}


}
