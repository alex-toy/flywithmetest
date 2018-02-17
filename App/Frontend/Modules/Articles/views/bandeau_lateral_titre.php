<div class="col-md-3">
<section class="encart bandeau_lateral">
		
<h2>Liste des <?= $nombreArticles ?> articles disponibles : </h2>
			
			

<?php
header( 'content-type: text/html; charset=utf-8' );
foreach ($listeAllTitle as $title_article)
{
?>


<h3 class="titre_vol" ><a rel="tooltip" title="texte pour récupérer l'info du serveur" href="articles-<?=$title_article['id'] ?>.html"><?=  $title_article->titre() ?></a></h3><br>

			
<?php
}
?>

</section>

</div>

