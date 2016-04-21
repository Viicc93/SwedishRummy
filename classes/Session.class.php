<?php
 /**
 * A class of starting, setting, getting and destroying session.
 *
 * The first parameter for startSession(), setSession() and getSession() methods
 * is the name of the session.
 *
 * The destroySession() method has one optional argument $location.
 * destroySession() method has the ability to destroy the session and redirect
 * the user to a specific web page.
 */
Class Session
{
	 /**
	 * Stores a session name if it is exests.
	 */
	private static $_sessionExists = false;
	 /**
	 * Start new or resume existing session.
	 * This method checks if the session is already exists, if it is not then
	 * will start the session and assign the value (true) to the $_sessionExists property.
	 */
	public static function startSession()
		{
			// Check if the session has been existed.
			if (self::$_sessionExists == false)
			{
				// Starting session
				session_start();
				self::$_sessionExists = true;
			}
		}
	/**
	* Delete Session description here
	*/
	 public static function deleteSession($name)
	 {
	 	if (self::getSession($name))
	 	{
	 		unset($_SESSION[$name]);
	 	}
	 }
	/**
	*	Description here
	*/
	public static function flashSession($name, $string = '')
	{
		if (self::getSession($name))
		{
			$session = self::getSession($name);
			self::deleteSession($name);
			return $session;
		}else
			{
				self::setSession($name, $string);
			}
	}
	 /**
	 * Sets name and value to a session. It has to parameter $name and $value.
	 * The first parameter for the session name, and the secon for the session value.
	 * This method sets session name to session value.
	 *
	 * @param string $name 		Name of the session.
	 * @param any	value of the session.
	 */
	public static function setSession($name, $value)
		{
			// Assign session name to a value.
			$_SESSION[$name] = $value;
		}
	 /**
	 * Gets the assigned session as an array.
	 * Its has one parameter ($name), the session name.
	 *
	 * @param string 	Name of the assigned session.
	 */
	public static function getSession($name)
		{
			// Checks if session has been set.
			if(isset($_SESSION[$name]))
				{
					return $_SESSION[$name];
				}else
					{
						return false;
					}
		}
	 /**
	 * Display the existed session, this method returns an array.
	 */
	public static function display()
		{
			echo "<pre>";
			print_r($_SESSION);
			echo "</pre>";
		}
	 /**
	 * Destroys all existed sessions. This method destroys all sessions
	 * by checking the $_sessionExists propery if it has a value.
	 * Then checks if there any session id or a cookies has a session name.
	 * Then destroys the session neme by sets it as an expired cookie.
	 * The optional argument sets a location to redirect the user to a specific web page
	 * to set a location, give the file's full URL.
	 *
	 * @param URL 	$location 	The full URL to file or web page that we want to be redirected to.
	 */
	public static function destroySession($location = false)
		{
			// Checks if sessions are existed.
			if(self::$_sessionExists == true)
				{
					// Sets the global $_SESSION[] to an array.
					$_SESSION = array();
					// Checks that there is a session_id or a cooki has a session name.
					if(session_id() != "" || isset($_COOKIE[session_name()]))
					// Unset th cookie by passing an expire time.
					setcookie(session_name(), '', time() - 42000, '/');
					// Destroys all sessions.
					session_destroy();
					// Redirect to a specific page if a URL has been given
					header('Location: ' . $location);
				}
		}
	public static function notIsset($name, $location)
		{
			if(!isset($_SESSION[$name])):
			{
				header('Location: ' . $location);
				exit();
			}
			endif;
		}
}
