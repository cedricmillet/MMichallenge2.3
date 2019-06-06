<?php
	include('_config.php');
	try {
		$options = array( PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'" );
		$pdo = @new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
	}
	catch( PDOException $exception ) {
		exit('Connexion à la base de données impossible - fichier: '.__FILE__);
	}



	//===========================================================

	if(@$_POST['action'] == 'get_question_user_index') {
		exit(get_user_question_index($_POST['user_id']));
	}
	if(@$_POST['action'] == 'set_question_user_index') {
		exit(set_user_question_index($_POST['user_id'], $_POST['user_question_index']));
	}
	if(@$_POST['action'] == 'restart_question_user_index') {
		exit(restart_question_user_index($_POST['user_id']));
	}

	if(@$_POST['action'] == 'get_question' && isset($_POST['question_id'])) {
		$q = get_question($_POST['question_id']);
		set_reponse($q);
	}


	



	


	//============= FUNCTIONS

	function set_reponse($rep) {
		$res = null;

		if(is_array($rep))
			$res = json_encode($rep);

		echo $res;
		exit;
	}


	// retourne la question pour un index spécifié
	function get_question($index) {

		$questions = array();
		$questions[1] = array(	'texte'=>'Quelle est la couleur du mur Nord en FA 300 ?', 
			'r1'=>'Rouge',
			'r2'=>'Blanc',
			'r3'=>'Bleu',
			'r4'=>'Jaune',
			'reponse'=>'1'
		);
		$questions[2] = array(	'texte'=>'Quelle est le premier langage de programmation à avoir existé ?', 
			'r1'=>'JAVA',
			'r2'=>'C',
			'r3'=>'HTML',
			'r4'=>'FORTRAN',
			'reponse'=>'4'
		);
		$questions[3] = array(	'texte'=>"Sous un fauteuil de la bibliothèque, kabemo a caché un livre contenant les plans de sa conquête de l’IUT. Combien y a-t-il de fauteuils ? Cela vous permettra de trouver le code pour déverrouiller le coffre du livre.", 
			'r1'=>'5',
			'r2'=>'4',
			'r3'=>'7',
			'r4'=>'10',
			'reponse'=>'4'
		);
		$questions[] = array(	'texte'=>"Combien font 28 octets en bits ?", 
			'r1'=>'224',
			'r2'=>'222',
			'r3'=>'230',
			'r4'=>'227',
			'reponse'=>'1'
		);
		$questions[] = array(	'texte'=>" Le livre vous indique la salle de réseau. Plus précisément, la baie de brassage. Combien y a-t-il de slots sur la baie de brassage ?", 
			'r1'=>'12',
			'r2'=>'24',
			'r3'=>'64',
			'r4'=>'1',
			'reponse'=>'2'
		);
		$questions[] = array(	'texte'=>"Lequel de ces OS existe réellement et permettrait de pénétrer dans le réseau hyper sécurisé du Dr Ali Oebkam ?", 
			'r1'=>'Ubuntu',
			'r2'=>'Mint',
			'r3'=>'Narvalow',
			'r4'=>'Forgis',
			'reponse'=>'1'
		);
		$questions[] = array(	'texte'=>"Oebkam a des hommes de main et le gérant est le seul à connaître la superficie de son réseau, qui est égale à la surface de Télomédia. Combien mesure-t-il ?", 
			'r1'=>'72 m²',
			'r2'=>'103 m²',
			'r3'=>'225 m²',
			'r4'=>'370 m²',
			'reponse'=>'4'
		);
		$questions[] = array(	'texte'=>"Au fait, sais-tu à quoi sert un fond vert ?", 
			'r1'=>'A se moucher',
			'r2'=>'Incruster des éléments',
			'r3'=>'A emballer des cadeaux',
			'r4'=>'Obtenir un meilleur eclairage',
			'reponse'=>'2'
		);
		$questions[] = array(	'texte'=>"Ali Oebkam vous donne rdv à l’entrée de l’IUT. Une fois que vous y êtes, nommez le bon plot dans la liste ci-dessous", 
			'r1'=>'Baou',
			'r2'=>'Farou',
			'r3'=>'Faron',
			'r4'=>'Coudon',
			'reponse'=>'3'
		);
		$questions[] = array(	'texte'=>"Vous avez réussi à rattrapper Ali Oebkam. Avez-vous aimé cette aventure ?", 
			'r1'=>'Oui beaucoup',
			'r2'=>'Oui',
			'r3'=>'Moyennement',
			'r4'=>'Non',
			'reponse'=>'2'
		);


		/*
			4 - a
			5 b
			6 a
			7 d
			8 b - changer la c
			9 nommez le bon plot, mettre une seul bonne reponse
			10 - adapter
			11 - 

		*/

		if(isset($questions[$index]))
			return $questions[$index];
		else return array('victoire');
	}


	function get_user_question_index($userid) {
		global $pdo;
		$stmt = $pdo->prepare("SELECT * FROM users WHERE userid=:uid AND api_key=:apikey LIMIT 1");
		$stmt->execute(['uid' => $userid, 'apikey'=>$_POST['api_key'] ]); 
		$data = $stmt->fetch();
		return $data['question'];		
	}

	function set_user_question_index($user_id, $user_question_index) {
		global $pdo;
		$stmt = $pdo->prepare("UPDATE users SET question=:qindex WHERE userid=:uid AND api_key=:apikey LIMIT 1");
		$r = $stmt->execute(['uid' => $user_id, 'apikey'=>$_POST['api_key'], 'qindex'=>$user_question_index ]); 
		$data = $stmt->fetch();
		return $r;	
	}

	function restart_question_user_index($user_id) {
		echo 'ok';
		global $pdo;
		$stmt = $pdo->prepare("UPDATE users SET question=1 WHERE userid=:uid AND api_key=:apikey");
		$r = $stmt->execute(['uid' => $user_id, 'apikey'=>$_POST['api_key']]); 
		$data = $stmt->fetch();
		var_dump($data);
		return $r;
	}