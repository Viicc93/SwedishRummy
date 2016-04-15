
<?php
spl_autoload_register(function ($className) {
		include "../classes/".$className.".class.php";
	});

try {

	if (isset($_POST['submit'])) {
		$name    = $_POST['User'];
		$player1 = new Player($name);
		print_r($player1);
	}

} catch (Exception $e) {

	echo $e;

}

?>
