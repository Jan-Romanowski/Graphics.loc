<?php

class CalendarController{


	/**
	 * Обычное отображение календаря
	 * @return bool
	 */
	public function actionView(){

		User::checkRoot('user');

		require_once(ROOT . '/views/calendar/index.php');

		return true;

	}

	/**
	 * Переключение месяцев в календаре
	 * @param $monthX
	 * @param $yearX
	 * @return bool
	 */
	public function actionSwitchMonth($monthX, $yearX){

		User::checkRoot('user');

		require_once(ROOT . '/views/calendar/index.php');

		return true;

	}


	/**
	 * Добавляем день как рабочий
	 * @return bool
	 */
	public function actionAddUserDay($monthX, $yearX){

		User::checkRoot('user');

		$date = Get::post('date', '');

		$user = $_SESSION['id'];
		if(!Graphic::isDayExistForUser($date)){

			$from = Get::post('time_from', '');
			$to = Get::post('time_to', '');
			$notes = ' ';

			Graphic::addDay($user, $date, $from, $to, $notes);

			$_SESSION["msg"] = "Sukcess! ".ComFunc::translateDate($date). " zaznaczyłeś że jesteś gotowy do pracy. ";
			$_SESSION["stat"] = "alert-success";

			}else{
			Graphic::deleteUserDay($user, $date);
		}

		 header("Location: /calendar/switchMonth/$monthX/$yearX/");

		return true;

	}

	/**
	 * Удаляем день как рабочий
	 * @param $date
	 * @return bool
	 */
	public function actionClear($date, $monthX, $yearX){

		User::checkRoot('user');

		$user = $_SESSION['id'];

		if(Graphic::deleteUserDay($date, $user)) {
			$_SESSION["msg"] = "Teraz ".ComFunc::translateDate($date). " możesz odpoczywać! ";
			$_SESSION["stat"] = "alert-success";
		}else{
			$_SESSION["msg"] = "Coś poszło nie tak.. ";
			$_SESSION["stat"] = "alert-danger";
		}

		header("Location: /calendar/switchMonth/$monthX/$yearX/");

		return true;

	}


}