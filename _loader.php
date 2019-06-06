<?php

//============================================
//				CONFIG
//============================================
include(dirname(__FILE__).'/_config.php');
if(!defined('ABSPATH')) exit('NECESSITE CONFIG.PHP - fichier:'.__FILE__);

$files = scandir(ABSPATH.'/assets/php/');
foreach ($files as $k => $file) {
	if($file=='.htaccess' 
		|| $file=="." 
		|| $file==".." 
		|| !is_file(ABSPATH.'/assets/php/'.$file)) 
		continue;

	require_once(ABSPATH.'/assets/php/'.$file);
}

//============================================
//				ERRORS
//============================================
if(ENABLE_DEVMODE) {
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
}

//============================================
//				SESSIONS
//============================================
session_start();

//============================================
//				GLOBAL VARIABLES
//============================================
$_pdo = null;
$_joueur = new Joueur();


try {
	$options = array( PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'" );
	$_pdo = @new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
}
catch( PDOException $exception ) {
	exit('Connexion à la base de données impossible - fichier: '.__FILE__);
}


//============================================
//				FUNCTIONS
//============================================