<div class="row">
<div class="col-sm-1"></div>
<div class="encart col-sm-10">


<?php
if($nombreComments == 0)
{
?>
<h2 style="text-align:left">Il n'y a actuellement aucun commentaire sur l'article <?= $title_article[0] ?>.</h2>


<?php
}
else if($nombreComments == 1)
{
?>
<h2 style="text-align:left">Il y a actuellement 1 commentaire sur l'article <?= $title_article[0] ?></h2>
<?php
}
else if($nombreComments > 1)
{
?>
<h2 style="text-align:left">Il y a actuellement <?= $nombreComments ?> commentaires sur l'article <?= $title_article[0] ?>. En voici la liste :</h2>




<?php
}
?>
<table class="table table-condensed">
  <thead>
      <tr>
        <th style="text-align:center">auteur</th>
        <th style="text-align:center">contenu</th>
        <th style="text-align:center">Supprimer</th>
      </tr>
    </thead><tbody>
<?php
foreach ($listeComments as $comment)
{
?> 
  <tr>
  		<td style="text-align:center"><?= $comment['auteur'] ?></td>
  		<td style="text-align:center"><?=  $comment['contenu'] ?></td>
  		<td style="text-align:center"><a href="/~alexei/FlyWithMeOC2/Web/admin/comment-delete-<?= $comment['id'] ?>-<?=  $id_article  ?>.html"><img src="/~alexei/FlyWithMeOC2/Web/images/listcomment.png" width="50" alt="Supprimer" /></a></td>

	</tr>
<?php
}
?>
</tbody></table>


<p><a class="btn btn-primary" href="/~alexei/FlyWithMeOC2/Web/admin/">Retourner à la liste des articles</a></p>


</div>
</div>


















































