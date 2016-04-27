<?php
/**
* A class for redirection, it give the ability to redirect a user to a specific web page.
* The class has one public static method called toPage().
**/

class Redirect
{
	 /**
	 * Redirect to a specific web page by using a full URL.
	 *
	 * @param string 	$page 	Name of the file.
	 **/
	public static function toPage($page)
		{
			if($page)
			{
				header('Location:' . $page);
				// Terminates execution of the script.
				exit();
			}
		}
}
