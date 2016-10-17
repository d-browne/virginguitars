<?php

  //start session in all pages
  if (session_status() == PHP_SESSION_NONE) { session_start(); } //PHP >= 5.4.0
  //if(session_id() == '') { session_start(); } //uncomment this line if PHP < 5.4.0 and comment out line above

	// sandbox or live
	define('PPL_MODE', 'sandbox');

	if(PPL_MODE=='sandbox'){
		
		define('PPL_API_USER', 'testsales_api1.virginguitars.com');
		define('PPL_API_PASSWORD', 'TK3GB3W6LKNJCAET');
		define('PPL_API_SIGNATURE', 'AFcWxV21C7fd0v3bYYYRCpSSRl31ALh993dB8d5ClOpfR1fdnWUMuFvx');
	}
	else{
		
		define('PPL_API_USER', 'somepaypal_api.yahoo.co.uk');
		define('PPL_API_PASSWORD', '123456789');
		define('PPL_API_SIGNATURE', 'opupouopupo987kkkhkixlksjewNyJ2pEq.Gufar');
	}
	
	define('PPL_LANG', 'EN');
	
	define('PPL_LOGO_IMG', 'http://www.sanwebe.com/wp-content/themes/sanwebe/img/logo.png');
	
	define('PPL_RETURN_URL', 'http://localhost/paypalexample/process.php');
	define('PPL_CANCEL_URL', 'http://localhost/paypalexample/cancel_url.php');

	define('PPL_CURRENCY_CODE', 'AUD');
