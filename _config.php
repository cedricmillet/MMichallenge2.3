<?php

	define('ABSPATH', dirname(__FILE__));

	define('ENABLE_DEVMODE', true);



	define('HASH_SALT_PASSWORD_PREFIX', 'aTq5EQT8Q2BRcMJiYot');



	//	SERVEUR MYSQL
	if(true) {
		define('DB_HOST', 'localhost');
		define('DB_DSN', 'mysql:host='.DB_HOST.';dbname=mmichallenge;port=3306');
		define('DB_USERNAME', 'root');
		define('DB_PASSWORD', '');
	} else {
		define('DB_HOST', 'XXXXXXXXX');
		define('DB_DSN', 'mysql:host='.DB_HOST.';dbname=mmichallenge;port=3306');
		define('DB_USERNAME', 'XXXXXXXXXXXXX');
		define('DB_PASSWORD', 'XXXXXXXXXXXXX');
	}
