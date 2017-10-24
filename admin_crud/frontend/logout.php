<?php
	session_start();
	session_destroy();
	unset($_SESSION['user']);
	$url = 1;
	echo json_encode($url);
?>