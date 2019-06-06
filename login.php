<?php require_once('_loader.php'); ?>
<?php

	$msg_conn = "";
	if(isset($_POST['j_pseudo']) && isset($_POST['j_password'])) {
		$login = $_POST['j_pseudo'];
		$pass = HASH_SALT_PASSWORD_PREFIX.'__'.hash('sha256', $_POST['j_password']);
		$statement = $_pdo->prepare("SELECT COUNT(*) as nbuser, userid FROM users WHERE (email=:login OR pseudo=:login) AND (mdp = :pass) LIMIT 1");
        $statement->bindValue(':login', $login);
        $statement->bindValue(':pass', $pass);
        $statement->execute();
        //$statement->debugDumpParams();
        $res = $statement->fetchAll()[0];
        if(intval($res['nbuser'])==1) {
        	//	Connexion OK
        	$userid = $res['userid'];
        	//echo $userid;
        	$_joueur->login($userid);
        } else {
        	// login / pass incorrect
        	$msg_conn = "Login / Password incorrect.";
        }
		//exit('fin login process');
	}


	if(@$_GET['succes_register']=='true')
		$msg_conn = "Votre compte a bien été créé !";
	
?>


<!DOCTYPE html>
<html>
<head>
	<title>Identification</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css?v=<?php echo uniqid(); ?>">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, minimal-ui, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<script src="../assets/js/jquery-1.12.4.js"></script>
  	<script src="../assets/js/jquery-ui.js"></script>
  	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>
	<div class="background-etoiles-terre fixed-fullwidth">
	<div id="jeu" class="fixed-fullwidth">
		<nav>
			<div id="deco-navbar">
				<div class="deco"></div>
			</div>
			<div id="container-navbar">
				Identification
			</div>
		</nav>

		

		<section id="container-identification">
			<form method="post">
				<!--<div class="form-title">Identification</div>-->
				<label>Pseudo</label><br>
				<?php if(isset($_GET['nick'])) { ?>
					<input class="form-input" type="text" name="j_pseudo" placeholder="Pseudo" value="<?php echo $_GET['nick']; ?>">
					<label>Mot de passe</label><br>
					<input class="form-input" type="password" name="j_password" placeholder="Votre mot de passe" value="">
				<?php } else { ?>
					<input class="form-input" type="text" name="j_pseudo" placeholder="Pseudo" value="demo">
					<label>Mot de passe</label><br>
					<input class="form-input" type="password" name="j_password" placeholder="Votre mot de passe" value="demo">
				<?php } ?>
				
				
				<center><input type="submit" value="Envoyer" /></center>
				<center><label id="connectstatus"><?php echo $msg_conn; ?></label></center>
			</form>
			<hr>
			<a href="../creation-compte"><i class="fas fa-lock"></i> Créer mon compte</a>
			<br><br>
			<a href="#"><i class="fas fa-question"></i> Mot de passe oublié</a>
		</section>

	
		<script type="text/javascript">
			/*
			$('form[method="post"]').on("submit", function(e){
				e.preventDefault();
				$('#connectstatus').html('Identification...');

				var login = $('input[name="j_pseudo"').val();
				var pass = $('input[name="j_password"').val();
				$.ajaxSetup({ cache: false });
				$.ajax({
					url : './',
					type : 'POST',
					data : 'login=' + login + '&pass=' + pass + '&ajax=true',
					dataType : 'text',
					async: true,
            headers: {
              "cache-control": "no-cache"
            },
					success : function(res, statut){
						alert("re=", res);
           				console.log(res);
           				if(res == 'true') {
           					window.location = "index.php";
           					$('#connectstatus').html('Succès !');
           				} else {
							$('#connectstatus').html('Mauvais identifiants.');
           				}
       				},
					error : function(resultat, statut, erreur){
						alert('error');
					},
					complete : function(resultat, statut){
						alert('complete');
					}

				});
			});
			*/
		</script>


	</div>
	</div>
</body>
</html>