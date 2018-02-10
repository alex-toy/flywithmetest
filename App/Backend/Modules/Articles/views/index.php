<div class="row">
  
  	<?php if ($user->hasFlash()) echo '<div class="col-sm-1"></div><div class="encart col-sm-10" style="text-align: center;">', $user->getFlash(), '</div>'; ?>
  
  
  
  <div class="col-sm-1"></div>
  <div class="encart col-sm-10">
  

<h2 class="button" style="text-align:left">Il y a actuellement <?= $nombreNews ?> articles. En voici la liste :</h2>
 
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
  echo 
  '<tr>
  		<td style="text-align:center"><p>', $art['depart'], '</p></td>
  		<td style="text-align:center">', $art['arrivee'], '</td>
  		<td style="text-align:center">le ', $art['dateAjout']->format('d/m/Y à H\hi'), '</td>
  		<td style="text-align:center">', ($art['dateAjout'] == $art['dateModif'] ? '-' : 'le '.$art['dateModif']->format('d/m/Y à H\hi')), '</td>
  		<td style="text-align:center"><a href="/~alexei/FlyWithMeOC2/Web/admin/articles-update-', $art['id'], '.html"><img src="/~alexei/FlyWithMeOC2/Web/images/update.png" width="50" alt="Modifier" /></a></td>
  		<td style="text-align:center"><a href="/~alexei/FlyWithMeOC2/Web/admin/articles-delete-', $art['id'], '.html"><img src="/~alexei/FlyWithMeOC2/Web/images/delete.png" width="50" alt="Supprimer" /></a></td>
  		<td style="text-align:center"><a href="/~alexei/FlyWithMeOC2/Web/admin/articles-list-comment-', $art['id'], '.html"><img src="/~alexei/FlyWithMeOC2/Web/images/listcomment.png" width="50" alt="Supprimer" /></a></td>
 		<td style="text-align:center"><a href="/~alexei/FlyWithMeOC2/Web/admin/articles-list-unvalidated-comment-', $art['id'], '.html"><img src="/~alexei/FlyWithMeOC2/Web/images/listcomment.png" width="50" alt="Valider" /></a></td>

  </tr>';
}
?>
</tbody></table>



<p><a class="btn btn-primary" href="/~alexei/FlyWithMeOC2/Web/admin/articles-insert.html">Créer un article</a></p>



</div>
</div>




