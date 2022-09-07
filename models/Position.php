<?php

class Position{

	/**
	 * @return array
	 */
	public static function getPositions(){

		$db = Db::getConnection();

		$positionsList = array();

		$result = $db->query("SELECT id, position 
                                    FROM positions; 
                         ");

		$result->setFetchMode(PDO::FETCH_ASSOC);

		$i = 0;
		while ($row = $result->fetch()) {
			$positionsList[$i]['id'] = $row['id'];
			$positionsList[$i]['position'] = $row['position'];
			$i++;
		}

		return $positionsList;

	}




}
