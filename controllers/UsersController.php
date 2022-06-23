<?php

class UsersController{

	/**
	 * @return bool
	 */
	public function actionRegister(){
		$name = '';
		$surname = '';
		$email = '';
		$pass1 = '';
		$pass2 = '';

		if (isset($_POST['submit']) && !empty($_POST['submit'])) {

			$name = Get::post('name', '');
			$surname = Get::post('surname', '');
			$email = Get::post('email', '');
			$pass1 = Get::post('pass1', '');
			$pass2 = Get::post('pass2', '');

			$errors = false;

			if (!User::checkName($name))
				$errors[] = 'Imię nie może być takie krótkie.';

			if (!User::chekSurname($surname))
				$errors[] = 'Nazwisko nie może być takie krótkie.';

			if (!User::chekEmail($email))
				$errors[] = 'Nieprawidłowy Email';

			if (!User::chekPasswords($pass1, $pass2))
				$errors[] = 'Hasła nie są jednakowe';

			if (!User::chekPassword($pass1))
				$errors[] = 'Nieprawidłowe hasło';

			if (User::checkEmailExists($email))
				$errors[] = 'Taki email już jest zajęty.';

			if (Queries::isQueryExist($email))
				$errors[] = 'Taki email już jest zajęty.';

			if ($errors == false) {

				if(!Queries::isQueryExist($email)) {
					if (Queries::register($name, $surname, $email, $pass1)) {

						$_SESSION["msg"] = "Wniosek o rejestrację został złożony. Poczekaj na zaakceptowanie danych przez administratora.";
						$_SESSION["stat"] = "alert-success";

//						$subject = "Rejestracja w bibliotece Chóru Katedralnego im. ks. Alfreda Hoffmana";
//						$message = "Witaj, ".$name."! Złożyłeś(aś) wniosek o rejestrację w bibliotece Chóru Katedralnego im. ks. Alfreda Hoffmana w Siedlcach. Musisz poczekać na akceptację przez administratorów systemu. Po akceptacji dostaniesz maila. \n\n\n\nZdrówka\nAdministracja Systemu";
//						ComFun::sendMail($email, $message, $subject);

//						header("Location: /users/login");

						$name = '';
						$surname = '';
						$email = '';
						$pass1 = '';
						$pass2 = '';

					} else {
						$_SESSION["msg"] = "Nie udało się założyć konta.";
						$_SESSION["stat"] = "alert-danger";
					}
				}
				else{
					$_SESSION["msg"] = "Wniosek o rejestrację został złożony. Poczekaj na zaakceptowanie danych przez administratora. ";
					$_SESSION["stat"] = "alert-danger";
				}
			}

		}

		require_once(ROOT . '/views/users/registForm.php');

		return true;
	}


	public function actionLogin()
	{

		$email = '';
		$pass = '';

		if (isset($_POST['submit'])) {

			$email = Get::post('email', '');
			$pass = Get::post('pass', '');

			$errors = false;

			if (!User::chekEmail($email))
				$errors[] = 'Nieprawidłowy email';

			if (!User::chekPassword($pass))
				$errors[] = 'Hasło ma być nie któtrze niż 6 symboli';

			$userData = array();
			$userData = User::checkUserData($email, $pass);

			if ($userData == false) {
				$errors[] = 'Nieprawidłowe dane dla logowania';
			} else {
				User::auth($userData);
				header("Location: /calendar/view");
				$_SESSION["msg"] = "Zapraszamy!";
				$_SESSION["stat"] = "alert-success";
			}

		}

		require_once(ROOT . '/views/users/loginForm.php');

		return true;
	}

}
