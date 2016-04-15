
<?php
spl_autoload_register(function ($className) {
		include "../classes/".$className.".class.php";
	});

try {

	if (isset($_POST['submit'])) {
		$name    = $_POST['User'];
		$player1 = new User($name);
		print_r($player1);

		$bot = new Bot();
		print_r($bot);
	}

} catch (Exception $e) {

	echo $e;

}

?>
