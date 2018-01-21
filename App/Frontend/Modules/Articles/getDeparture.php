<!-- Connexion Bdd -->
<?php
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=news;charset=utf8', 'root', 'root');
	}
	catch (Exception $e)
	{
			die('Erreur : ' . $e->getMessage());
	}
?>	






<!--  liste départs -->
<?php
	echo 'liste départs<br>';
	$reponse = $bdd->query('SELECT depart FROM article');
	while ($donnees = $reponse->fetch())
	{    
		echo "<tr><td>" . $donnees['depart'] . "</td></tr>";
	}
	
?>






