<?php 
	require_once '../../Controller/google_controller_configue.php';
	session_start();
	session_destroy();
	$gClient->revokeToken();
	header('location:../starting_page.php');
 ?>