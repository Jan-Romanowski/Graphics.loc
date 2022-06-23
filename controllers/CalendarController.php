<?php

class CalendarController{


	/**
	 * @return bool
	 */
	public function actionView(){

		require_once(ROOT . '/views/calendar/index.php');

		return true;

	}


	/**
	 * @return bool
	 */
	public function actionAddUserDay(){

		$date = Get::post('date', '');

		echo $date;

		$user = $_SESSION['id'];
		if(!Graphic::isDayExist($date)){
			$position = ' ';
			$from = '00:00:00';
			$to = '00:00:00';
			$notes = ' ';

			Graphic::addDay($user, $date, $position, $from, $to, $notes);

			$_SESSION["msg"] = "Sukcess! ".$date. " zaznaczyłeś że jesteś gotowy do pracy. ";
			$_SESSION["stat"] = "alert-success";

			}else{
			Graphic::deleteUserDay($user, $date);
		}

		 header("Location: /calendar/view");

		return true;

	}

	public function actionClear($date){

		$user = $_SESSION['id'];

		if(Graphic::deleteUserDay($date, $user)) {
			$_SESSION["msg"] = "Teraz ".$date. " możesz odpoczywać! ";
			$_SESSION["stat"] = "alert-success";
		}else{
			$_SESSION["msg"] = "Coś poszło nie tak.. ";
			$_SESSION["stat"] = "alert-danger";
		}

		header("Location: /calendar/view");

		return true;

	}

}