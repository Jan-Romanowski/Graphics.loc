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

		$dayList = array();
		$dayList = Graphic::getDayByDate($date);

		require_once(ROOT . '/views/admin/daySettings.php');

		return true;

	}

}
