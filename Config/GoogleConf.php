<?php
//----Google Api para el login----//
	
	$google_client = new Google_Client();
	//Set the OAuth 2.0 Client ID
	$google_client->setAuthConfig('client_secret.json');
	$google_client->setClientId('841805979992-65n3g551rbig046760e15gnvktea2m34.apps.googleusercontent.com');
	//Set the OAuth 2.0 Client Secret key
	$google_client->setClientSecret('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');
	//Set the OAuth 2.0 Redirect URI
	$google_client->setRedirectUri(BASE_URL.'Registro');
	// to get the email and profile 
	$google_client->addScope('email');
	$google_client->addScope('profile');
    ?>