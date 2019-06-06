<?php

	function sql_get_current_user_data() {
		global $_pdo;
		$stmt = $_pdo->prepare("SELECT * FROM users WHERE userid=:uid LIMIT 1");
		$stmt->execute([ 'uid' => $_SESSION['user_id'] ]); 
		$data = $stmt->fetch();
		return $data;	
	}