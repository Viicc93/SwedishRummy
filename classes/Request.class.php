<?php
// Input.php

class Request
{
	// form validation
	// this class can be used to validate $_POST and $_GET
	// check if $_POST or $_GET have data
	public function resExists($type = 'post')
	{
		switch ($type) {
			case 'post':
				return (!empty($_POST)) ? true : false;
				break;

			case 'get':
				return (!empty($_GET)) ? true : false;
				break;

				case 'file':
				return (!empty($_FILES)) ? true : false;
				break;

			default:
				return false;
				break;
		}
	}
	// get the data from $_POST or $_GET
	public function getRequest($item , $name = null)
	{
		if (isset($_POST[$item])) {
			return $_POST[$item];
		}elseif (isset($_GET[$item])) {
			return $_GET[$item];
		}

		return '';
	}

	public function getFile($item, $name)
	{
		if (isset($_FILES[$item][$name]))
		{
			return $_FILES[$item][$name];
		}
	}
}
