<?php

class ComFunc{


	/**
	 * @param $month
	 * @return string|void
	 */
	static function getMonthA($month){

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


	static function getMonth($month){

		switch ($month){
			case '1':
				return 'Styczeń';
			case '2':
				return 'Luty';
			case '3':
				return 'Marzec';
			case '4':
				return 'Kwiecień';
			case '5':
				return 'Maj';
			case '6':
				return 'Czerwiec';
			case '7':
				return 'Lipiec';
			case '8':
				return 'Sierpień';
			case '9':
				return 'Wrzesień';
			case '10':
				return 'Październik';
			case '11':
				return 'Listopad';
			case '12':
				return 'Grudzień';
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

	/**
	 * Функция которая проверяет, является ли указанная дата сегодняшней
	 * @param $day
	 * @param $month
	 * @param $year
	 * @return bool
	 */
	static function isThisToday($day, $month, $year){

		$today = getdate();

		$currentDay = $today['mday'];
		$currentMonth = $today['mon'];
		$currentYear = $today['year'];

		if($day == $currentDay &&
			$month == $currentMonth &&
			$year == $currentYear){
			return true;
		}
		return false;
	}

	/**
	 * @param $value
	 * @param $words
	 * @param bool $show
	 * @return string
	 */
	static function num_word($value, $words, $show = true)
	{
		$num = $value % 100;
		if ($num > 19) {
			$num = $num % 10;
		}

		$out = ($show) ?  $value . ' ' : '';
		switch ($num) {
			case 1:  $out .= $words[0]; break;
			case 2:
			case 3:
			case 4:  $out .= $words[1]; break;
			default: $out .= $words[2]; break;
		}

		return $out;
	}

	static function secToStr($secs)
	{
		$res = '';

		$days = floor($secs / 86400);
		$secs = $secs % 86400;
		if($days>0){
			$res .= self::num_word($days, array('dzień', 'dni', 'dni')) . ' ';
		}
		elseif($days < 1){
			$hours = floor($secs / 3600);
			$secs = $secs % 3600;
			if($hours>0){
				$res .= self::num_word($hours, array('godzina', 'godziny', 'godzin')) . ' ';
			}
			elseif($hours < 5){
				$minutes = floor($secs / 60);
				$secs = $secs % 60;
				if($minutes>0){
					$res .= self::num_word($minutes, array('minuta', 'minuty', 'minut')) . ' ';
				}
				elseif ($minutes<30){
					$res .= self::num_word($secs, array('sekunda', 'sekundy', 'sekund'));
				}
			}

		}

		return $res;
	}

	static function translateDate($date){

		$monthes = [1 => 'stycznia', 2 => 'lutego', 3 => 'marca', 4 => 'kwietnia', 5 => 'maja', 6 => 'czerwca',
			7 => 'lipca', 8 => 'sierpnia', 9 => 'września', 10 => 'października', 11 => 'listopada', 12 => 'grudnia'];
	
		$string = $date;
		$year = mb_strcut($string,0, 4);
		$monthId = (int) mb_strcut($string,5, 2);
		$day = (int) mb_strcut($string,8, 2)."-go";
	
		return $day." ".$monthes[$monthId]." ".$year;
	
	}

}
