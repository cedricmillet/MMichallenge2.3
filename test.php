<?php require_once('_loader.php');



	$pass = $_GET['pass'];
	$hashed = HASH_SALT_PASSWORD_PREFIX.'__'.hash('sha256', $pass);




	echo 'Mot de passe hashé ('.$pass.') : <input type="text" style="width:100%" value="'.$hashed.'" />';