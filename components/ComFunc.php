<?php

class ComFunc{


	/**
	 * @param $month
	 * @return string|void
	 */
	static function getMonth($month){

		switch ($month){
			case '1':
				return 'Stycznia';
			case '2':
				return 'Lutego';
			case '3':
				return 'Marca';
			case '4':
				return 'Kwietnia';
			case '5':
				return 'Maja';
			case '6':
				return 'Czerwca';
			case '7':
				return 'Lipca';
			case '8':
				return 'Sierpnia';
			case '9':
				return 'Września';
			case '10':
				return 'Października';
			case '11':
				return 'Listopada';
			case '12':
				return 'Grudnia';
		}

	}


	static function getDay($day){
		switch ($day){
			case '0':
				return 'Niedziela';
			case '1':
				return 'Poniedziałek';
			case '2':
				return 'Wtorek';
			case '3':
				return 'Środa';
			case '4':
				return 'Czwartek';
			case '5':
				return 'Piątek';
			case '6':
				return 'Sobota';
		}
	}

}
