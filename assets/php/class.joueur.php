<?php
	if(!defined('ABSPATH')) exit('ACCES DIRECT INTERDIT');

	/**
	 * 
	 */
	class Joueur
	{
		
		function __construct( $args = array() )
		{
			$this->username = "N/A";

		}

		function userIsLogged() {
			if($_SESSION['user_is_logged']==true)
				return true;
			return false;
		}

		function login($id=0) {
			

			$_SESSION['user_is_logged'] = true;
			$_SESSION['user_id'] = $id;
			header('location: ../index.php');
		}

		function logout() {
			$_SESSION['user_is_logged'] = false;
			unset($_SESSION['user_id']);
			header('location: ./');
			exit('Deconnexion effectuee.');
		}

		function redirectToLoginPage() {
			header('location: connexion/');
			exit('redirection vers la page connexion echouee. ficher:'.__FILE__.' - ligne: '.__LINE__);
		}
	}