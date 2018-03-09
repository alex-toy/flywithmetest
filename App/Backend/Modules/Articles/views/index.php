<div class="row">
  
  	<?php if ($user->hasFlash()){ ?>  
  		<div class="col-sm-1"></div><div class="encart col-sm-10" style="text-align: center;"><?=  $user->getFlash() ?></div>
  	<?php } ?>  
  
  
  <div class="col-sm-1"></div>
  <div class="encart col-sm-10">
  

 
<table class="table table-condensed">
  <thead>
      <tr>
        <th style="text-align:center">Départ</th>
        <th style="text-align:center">Arrivée</th>
        <th style="text-align:center">Date d'ajout</th>
        <th style="text-align:center">Dernière modification</th>
        <th style="text-align:center">modifier</th>
        <th style="text-align:center">supprimer</th>
        <th style="text-align:center">liste des commentaires</th>
        <th style="text-align:center">liste des commentaires à valider</th>
      </tr>
    </thead><tbody>
<?php
foreach ($listeArticles as $art)
{
?> 
  <tr>
  		<td style="text-align:center"> <?= $art['depart'] ?> </td>
  		<td style="text-align:center"> <?=  $art['arrivee'] ?>  </td>
  		
		<td style="text-align:center">le <?= $art['dateAjout']->format('d/m/Y à H\hi') ?> </td>
  		<td style="text-align:center"> <?= ($art['dateAjout'] == $art['dateModif'] ? '-' : 'le ' . $art['dateModif']->format('d/m/Y à H\hi')) ?> </td>
  		<td style="text-align:center"><a href="/~alexei/FlyWithMeOC2/Web/admin/articles-update-<?= $art['id'] ?>.html"><img src="/~alexei/FlyWithMeOC2/Web/images/update.png" width="50" alt="Modifier" /></a></td>
  		<td style="text-align:center"><a onclick="deleteArticle(<?= $art['id'] ?>)" ><img src="/~alexei/FlyWithMeOC2/Web/images/delete.png" width="50" alt="Supprimer" /></a></td>

  		<td style="text-align:center"><a href="/~alexei/FlyWithMeOC2/Web/admin/articles-list-comment-<?= $art['id'] ?>.html"><img src="/~alexei/FlyWithMeOC2/Web/images/listcomment.png" width="50" alt="Supprimer" /></a></td>
 		<td style="text-align:center"><a class="btn btn-primary" href="/~alexei/FlyWithMeOC2/Web/admin/articles-list-unvalidated-comment-<?= $art['id'] ?>.html"><?= $NumberUnvalidatedComments[$art['id']] ?></a></td>
 	
  </tr>
<?php
}
?>
</tbody></table>



<a class="btn btn-primary" href="/~alexei/FlyWithMeOC2/Web/admin/articles-insert.html">Créer un article</a>



</div>
</div>



<div class="col-sm-1"></div>
<div class="encart col-sm-10">
<a class="btn btn-primary" href="/~alexei/FlyWithMeOC2/Web/admin/pilotes/">gestion des pilotes</a>
</div>


<script>
function deleteArticle(id) {
	if (confirm("êtes vous sûr de vouloir supprimer cet article ?")) { 
		var redirect = "http://localhost/~alexei/FlyWithMeOC2/Web/admin/articles-delete-" + id + ".html"; 
		//alert(redirect);
		document.location.href=redirect; 	
	}
}
</script>



