<section class="encart articles">

<p>Publié le <?= $article['dateAjout']->format('d-m-Y') ?></p>
<h2><?= $article['titre'] ?></h2>
<p><?= nl2br($article['contenu']) ?></p>
 
<?php if ($article['dateAjout'] != $article['dateModif']) { ?>
  <p style="text-align: right;"><small><em>Dernière modification le <?= $article['dateModif']->format('d/m/Y à H\hi') ?></em></small></p>
<?php } ?>
</section>

 
<?php
if (empty($comments))
{
?>
<section class="commentaire">
<p>Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
</section>
<?php
}

foreach ($validatedcomments as $comment)
{
?>
<section class="commentaire">
  <legend>
    Posté par <strong><?= htmlspecialchars($comment['auteur']) ?></strong> le <?= htmlspecialchars($comment['date']->format('d/m/Y à H\hi')) ?>
  </legend>
  <p><?= nl2br(htmlspecialchars($comment['contenu'])) ?></p>
</section>

<?php
}
if(htmlspecialchars($_SESSION['connected'])){ ?>
	
	<a class="btn btn-primary" href="commentaire-<?= $article['id'] ?>.html">Ajouter un commentaire</a></p>
<?php 
}
else{
?>
	<a disabled class="btn btn-primary">Ajouter un commentaire</a></p>

<?php
}
?>








