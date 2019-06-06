<?php require_once('_loader.php'); ?>
<?php
	if(!$_joueur->userIsLogged()) {
		$_joueur->redirectToLoginPage();
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>MMiChallenge</title>
		<link rel="stylesheet" type="text/css" href="assets/css/style.css?v=<?php echo uniqid(); ?>">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, minimal-ui, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<script src="assets/js/jquery-1.12.4.js"></script>
		<script src="assets/js/jquery-ui.js"></script>
	  	<script src="assets/js/typeit.min.js"></script>
	  	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	</head>
	<body>
		<div class="background-etoiles fixed-fullwidth">
		<div id="jeu" style="height:100vh">
			<nav>
				<div id="deco-navbar">
					<div class="deco"></div>
				</div>
				<div id="container-navbar">
					MMiChallenge
					<img src="assets/img/icons/burger.png" id="mobilemenu_icon" />
				</div>
			</nav>

			<section id="container-question">
				<!--<img id="personnage" src="assets/img/personnages/" /> -->
				<div id="text-question"></div>
			</section>
			

			<section id="container-reponses">
				
				<section id="liste-reponses">
					<svg id="container-reponses-tab-left" xmlns="http://www.w3.org/2000/svg" width="112" height="24" viewBox="0 0 112 24"><path fill-rule="evenodd" d="M0 0h76.524c2.766 0 6.63 1.538 8.637 3.439l18.07 17.122c2.003 1.9 5.868 3.439 8.62 3.439H112 0V0z"></path></svg>
					<svg id="container-reponses-tab-right" xmlns="http://www.w3.org/2000/svg" width="114" height="24" viewBox="0 0 114 24"><path fill-rule="evenodd" d="M.317 24c2.761 0 6.62-1.547 8.616-3.451L26.847 3.45C28.844 1.545 32.697 0 35.469 0H114v24H0h.317z"></path></svg>
					<div class="container-futurist"></div>

					<div class="reponse" data-index="1"><p>[Q1]</p></div>
					<div class="reponse" data-index="2"><p>[Q2]</p></div>
					<div class="reponse" data-index="3"><p>[Q3]</p></div>
					<div class="reponse" data-index="4"><p>[Q4]</p></div>
				</section>
			</section>
		</div>

		<?php
			$userdata = sql_get_current_user_data();
		?>
	<!-- donnees joueur -->
		<input type="hidden" id="usrdata_playerid" value = "<?php echo $userdata['userid']; ?>" />
		<input type="hidden" id="usrdata_playerapikey" value = "<?php echo $userdata['api_key']; ?>" />

		<div id="sidemenu" data-display="false">
			<div class="container">
				<img src="assets/img/icons/next.png" class="icon-next close-sidemenu" />
				<div id="title">MMichallenge</div>
				<img src="assets/img/logos/logo.png" class="logo" />

				<a class="menu-btn" href="http://mmichallenge.theo-murcia.fr/">Retour au site</a>
				<div class="clear"></div>
				<a class="menu-btn" href="deconnexion">Deconnexion</a>
			</div>
		</div>
	</div>
	</body>
	<script src="assets/js/game.js?v=<?php echo uniqid(); ?>"></script>

</html>