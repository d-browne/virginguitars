<?php

  //start session in all pages
  //if (session_status() == PHP_SESSION_NONE) { session_start(); } //PHP >= 5.4.0
  if(session_id() == '') { session_start(); } //uncomment this line if PHP < 5.4.0 and comment out line above

	// sandbox or live
	define('PPL_MODE', 'sandbox');

	if(PPL_MODE=='sandbox'){
		
		define('PPL_API_USER', 'biz_api1.virginguitars.com');
		define('PPL_API_PASSWORD', 'KQJAVTN7258LNV86');
		define('PPL_API_SIGNATURE', 'AFcWxV21C7fd0v3bYYYRCpSSRl31Aj.azKVtnSa08N07-FfgtkxKFisk');
	}
	else{
		
		define('PPL_API_USER', 'somepaypal_api.yahoo.co.uk');
		define('PPL_API_PASSWORD', '123456789');
		define('PPL_API_SIGNATURE', 'opupouopupo987kkkhkixlksjewNyJ2pEq.Gufar');
	}
	
	define('PPL_LANG', 'EN');
	
	define('PPL_LOGO_IMG', 'http://bytecube.net/vgpplogo.png');
	
	define('PPL_RETURN_URL', 'http://localhost/virginguitars/process.php');
	define('PPL_CANCEL_URL', 'http://localhost/virginguitars/checkout.php');

	define('PPL_CURRENCY_CODE', 'AUD');
