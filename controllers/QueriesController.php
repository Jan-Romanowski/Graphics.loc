<?php

class QueriesController{

	public function actionQueriesView()
	{

		User::checkRoot('admin');

		$queriesList = array();
		$queriesList = Queries::getQueries();

		$positionsList = array();
		$positionsList = Position::getPositions();

		require_once(ROOT . '/views/queries/index.php');

		return true;
	}

	function actionDeleteQuery($id)
	{

		User::checkRoot("admin");

		if ($id) {
			if (Queries::deleteQuery($id)) {
				$_SESSION["msg"] = "Wniosek został pomyślnie usunięty";
				$_SESSION["stat"] = "alert-success";
			} else {
				$_SESSION["msg"] = "Coś poszło nie tak..";
				$_SESSION["stat"] = "alert-danger";
			}
		}

		header('Location: /queries/');

		return true;
	}


	function actionTransferQuery($id)
	{

		User::checkRoot("admin");

		// $rank = Get::post('rank', '');
		$position = Get::post('position', '');

		$rank = Get::post('user', '');
		$position = 1;

		$query = array();
		$query = Queries::getQueryById($id);

		if (Queries::transferQuery($id, $rank, $position)) {

//			$subject = "Rejestracja w bibliotece Chóru Katedralnego im. ks. Alfreda Hoffmana";
//			$message = "Witaj, ".$query['name']."! Twój wniosek o rejestrację w bibliotece Chóru Katedralnego im. ks. Alfreda Hoffmana w Siedlcach został zaakceptowany. Już możesz się zalogować do systemu. \n\n\n\nZdrówka\nAdministracja Systemu";
//
//			ComFun::sendMail($query['email'], $message, $subject);

			$_SESSION["msg"] = "Użytkownik został pomyślnie dodany do systemu";
			$_SESSION["stat"] = "alert-success";
			header('Location: /queries');

		} else {
			$_SESSION["msg"] = "Coś poszło nie tak..";
			$_SESSION["stat"] = "alert-danger";

			header('Location: /queries');
		}
		return true;
	}




}
