<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css" />
		<title>Mini chat</title>
	</head>
	<body>
		<header>
			<h1>miniChat et gros minet</h1>
		</header>

		<div class="minichat">
			
			<form action="minichat_post.php" method="post">
				<p>
					<fieldset>
						<legend>Pseudo</legend>
						<input type="text" name="pseudo" id="pseudo"  placeholder="Pseudo" size="30" maxlength="10" value="<?php echo $_COOKIE['pseudo'] ?>" required/>
					</fieldset>
					
					<fieldset>
						<legend>Message</legend>
						<textarea name="message" id="message" rows="10" cols="40" required></textarea>
					</fieldset> 

				</P>
				<input type="submit" value="Envoyer votre message" />
			</form>
		</div>

<?php

	// Connection to the database
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root');
	}
	catch(Exception $e)
	{
	        die('Erreur : '.$e->getMessage());
	}


	// recovery of the last ten messages
	$reponse = $bdd->query('SELECT pseudo, message, DATE_FORMAT(date_creation, \'%d-%m-%Y à %Hh%imin%ss\') AS date_creation_fr FROM minichat ORDER BY ID DESC LIMIT 0, 10');

	// post each message (protected by htmlspecialchars)
	while ($data = $reponse->fetch())
	{
	    echo '<p>' . '<strong>' . htmlspecialchars($data['pseudo']) . '</strong> : ' . htmlspecialchars($data['message']) . '<br />' . $data['date_creation_fr'] . '</p>';
	}

	$reponse->closeCursor();

?>

	</body>

</html>
