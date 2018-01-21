<?php

foreach ($listeArticles as $articles)
{
?>
  <section class="encart all">
  <h2><a href="articles-<?= $articles['id'] ?>.html"><?= $articles['titre'] ?></a></h2><p>publié le <?= nl2br($articles['dateAjout']->format('d-m-Y')) ?>, dernière modification le <?= nl2br($articles['dateModif']->format('d-m-Y')) ?></p>
  <p><?= nl2br($articles['contenu']) ?></p>
  </section>
<?php
}





			
			
			
			
			
        
        