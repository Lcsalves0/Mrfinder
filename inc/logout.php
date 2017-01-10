<?php

	session_start();
	
	unset($_SESSION['usernameSession']);
	unset($_SESSION['passwordSession']);
	header('Location: ../index.php');
		exit();

?>