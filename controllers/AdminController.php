<?php

class AdminController{

	/**
	 * Просмотреть список пользователей
	 * @return bool
	 */

	public function actionIndex(){

		User::checkRoot('admin');

		require_once(ROOT . '/views/admin/index.php');

		return true;

	}

	public function actionUserListShow(){

		User::checkRoot('admin');

		if (isset($_POST['submit'])) {
			$word = Get::post('word', '');
		}
		else{
			$word = '';
		}

		$userList = array();
		$userList = User::getUsers($word);


		require_once(ROOT . '/views/admin/userList.php');

		return true;

	}

	/**
	 * Обычное отображение календаря
	 * @return bool
	 */
	public function actionView(){

		User::checkRoot('admin');

		require_once(ROOT . '/views/admin/adminCalendar.php');

		return true;

	}

	/**
	 * Переключение месяцев в календаре
	 * @param $monthX
	 * @param $yearX
	 * @return bool
	 */
	public function actionSwitchMonth($monthX, $yearX){

		User::checkRoot('admin');

		require_once(ROOT . '/views/admin/adminCalendar.php');

		return true;

	}


	public function actionDaySettings($date){

		User::checkRoot('admin');

		$dayUsersList = array();
		$dayUsersList = Graphic::getDayUsersByDate($date);

		$dayFirmList = array();
		$dayFirmList = Graphic::getDayFirmByDate($date);

		require_once(ROOT . '/views/admin/daySettings.php');

		return true;

	}

	// id, date, user, time_to, time_from, notes 
	public function actionTransferDayFromUserToFirm($id){

		User::checkRoot("admin");

		$dayList = array();
		$dayList = Graphic::getDayById($id);

		// echo "<pre>";
		// print_r($dayList);
		// echo "</pre>";

		$from = Get::post('time_from', '');
		$to = Get::post('time_to', '');
		$notes = Get::post('notes', '');

		Graphic::transferDayFromUserToFirm($dayList[0]['user'], $dayList[0]['date'], $from, $to, $notes);

		$_SESSION["msg"] = "Sukcess! ".$date. " Zatwierdziłeś grafik dla użytkownika. ";
		$_SESSION["stat"] = "alert-success";

		$date = $dayList[0]['date'];

		header("Location: /admin/daySettings/$date");

		return true;

	}

	public function actionDeleteDayForUserFromFirmGraphic($userId, $date){

		User::checkRoot("admin");

		if(Graphic::deleteDayForUserFromFirmGraphic($userId, $date)) {
			$_SESSION["msg"] = "Pomyślnie usunięto! ";
			$_SESSION["stat"] = "alert-success";
		}else{
			$_SESSION["msg"] = "Coś poszło nie tak.. ";
			$_SESSION["stat"] = "alert-danger";
		}

		header("Location: /admin/daySettings/$date");

		return true;
	
	}

	public function actionWeekGraphic(){

		User::checkRoot("admin");



	}

}
