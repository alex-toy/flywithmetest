<?php
foreach ($listeArticles as $articles)
{
?>
  <section class="encart">
  <h2><a href="articles-<?= $articles['id'] ?>.html"><?= $articles['titre'] ?></a></h2>
  <p><?= nl2br($articles['contenu']) ?></p>
  </section>
<?php
}



			
			
			
			
			
        
        