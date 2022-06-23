<?php
/*
 *
 */

class Get
{

	const TYPE_INT = 'int';
	const TYPE_FLOAT = 'float';
	const TYPE_STR = 'string';
	const TYPE_TRIM_STR = 'trim_string';
	const TYPE_ISSET = 'isset';

	function __construct()
	{

	}

	/**
	 * Returns value from _GET
	 *
	 * @param string $name
	 * @param string $def
	 * @param string $type
	 * @return string
	 */
	static function get($name = '', $def = false, $type = '')
	{
		if (!is_string($name) || !$name)
			return false;
		$data = isset($_GET[$name]) ? $_GET[$name] : $def;

		switch ($type) {
			case self::TYPE_INT:
				$data = (int)$data;
				break;
			case self::TYPE_FLOAT:
				$data = (float)$data;
				break;
			case self::TYPE_STR:
				$data = get::escape($data);
				break;
			case self::TYPE_TRIM_STR:
				$data = trim(get::escape($data));
				break;
			case self::TYPE_ISSET:
				return isset($_GET[$name]);
		}
		return $data;
	}

	/**
	 * Returns value from _POST
	 *
	 * @param string $name
	 * @param string $def
	 * @param string $type
	 * @param bool $_specialchars
	 * @return string
	 */
	static function post($name = '', $def = false, $type = '', $_specialchars = 0)
	{
		$data = isset($_POST[$name]) ? $_POST[$name] : $def;

		switch ($type) {
			case self::TYPE_INT:
				$data = (int)$data;
				break;
			case self::TYPE_FLOAT:
				$data = (float)$data;
				break;
			case self::TYPE_STR:
				$data = get::escape($data);
				break;
			case self::TYPE_TRIM_STR:
				$data = trim(get::escape($data));
				break;
			case 'array_of_int':
				if (is_array($data) && count($data) > 0) {
					$_data = array();
					foreach ($data as $key => $value) {
						$value = intval($value);
						if (!in_array($value, $_data)) {
							$_data[$key] = $value;
						}
					}
					$data = $_data;
				}
				break;
			case 'array_of_string':
				if (is_array($data) && count($data) > 0) {
					$_data = array();
					foreach ($data as $key => $value) {
						$value = trim(get::escape($value));
						if (!in_array($value, $_data)) {
							$_data[$key] = $value;
						}
					}
					$data = $_data;
				}
				break;
		}
		if ($_specialchars) $data = htmlspecialchars($data);

		return $data;
	}

	/**
	 * escapes string for sql
	 *
	 * @param string $data
	 * @return string
	 */
	static function escape($data)
	{
		global $conn;
		return mysqli_real_escape_string($conn, $data);
	}
}
