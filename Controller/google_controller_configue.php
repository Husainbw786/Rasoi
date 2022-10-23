<?php
	// session_start();
	require_once "vendor/autoload.php";
	$gClient = new Google_Client();
	$gClient->setClientId("277772212305-gi9580cuuqp4iqn335hj7onb9pkuumhs.apps.googleusercontent.com");
	$gClient->setClientSecret("Ly61lRTCQSD0Vw3WHG5pmjav");
	$gClient->setApplicationName("Rasoi");
	$gClient->setRedirectUri("");
	$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");

/*
Example

Redirection URL
http://localhost/CoreRasoi/Controller/google_auth.php
http://localhost/CoreRasoi/ this part is your domain which you set in app.ini as APP_URL. 
Controller/google_auth.php it is fixed add this to your domain.

 */
?>