<?php require_once('_loader.php'); ?>
<?php

	$msg_conn = "";
	if(isset($_POST['r_pseudo']) && isset($_POST['r_password'])) {
		$login = $_POST['r_pseudo'];
		$pass = HASH_SALT_PASSWORD_PREFIX.'__'.hash('sha256', $_POST['r_password']);
		$statement = $_pdo->prepare("INSERT INTO users(email, mdp, pseudo, api_key) VALUES (:mail, :pass, :login, :apikey);");
        $statement->bindValue(':mail', $_POST['r_email']);
        $statement->bindValue(':login', $login);
        $statement->bindValue(':pass', $pass);
        $statement->bindValue(':apikey', uniqid() );
        $res = $statement->execute();
        if($res)
        {
        	header('location: ./connexion/?succes_register=true&nick='.$login);
        	exit('echec redirection');
        }
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Creation compte</title>
	<link rel="stylesheet" type="text/css" href="./assets/css/style.css?v=<?php echo uniqid(); ?>">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, minimal-ui, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<script src="./assets/js/jquery-1.12.4.js"></script>
  	<script src="./assets/js/jquery-ui.js"></script>
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
				Enregistrement
			</div>
		</nav>

		

		<section id="container-identification">
			<form method="post">
				<!--<div class="form-title">Identification</div>-->
				<label>Pseudo</label><br>
				<input class="form-input" type="text" name="r_pseudo" placeholder="Pseudo">
				<label>Email</label><br>
				<input class="form-input" type="email" name="r_email" placeholder="exemple@gmail.com">
				<label>Mot de passe</label><br>
				<input class="form-input" type="password" name="r_password" placeholder="Votre mot de passe">
				
				<center><input type="submit" value="Créer mon compte" /></center>
				<center><label id="connectstatus"><?php echo $msg_conn; ?></label></center>
			</form>
			<hr>
			<a href="./"><i class="fas fa-arrow-left"></i> Retour à l'accueil</a>
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