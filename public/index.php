<?php
//echo $_SERVER['PHP_SELF'];

if( !isset( $_SESSION ) ) {
    // session isn't started
	// start new session
    session_start();
	
	$_SESSION['START_TIME'] = time();

}


include_once("../controller.php");

$controller = new Controller();


?>
