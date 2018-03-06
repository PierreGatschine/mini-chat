<?php

// Recover variables and formatting
$pseudo = ucfirst(strtolower($_POST['pseudo']));
$message = ucfirst(strtolower($_POST['message']));

// Creation of a cookie to automatically fill out the form
setcookie('pseudo', $pseudo, time() + 3600, null, null, false, true);

//connection to the Db
try 
{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root');
	
} 
catch (Exception $e) 
{
	die('Erreur : ' . $e->getMessage());
}

// Inserting the message using a prepared query
$req = $bdd->prepare('INSERT INTO minichat (pseudo, message, date_creation) VALUES(?, ?, Now())');

//$req->execute(array($_POST['pseudo'], $_POST['message']));

$req->execute(array($pseudo, $message));
// Redirecting the visitor to the minichat page
header('Location: minichat.php');

?>
