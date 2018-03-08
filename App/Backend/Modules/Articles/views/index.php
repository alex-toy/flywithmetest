<div class="row">
  
  	<?php if ($user->hasFlash()) echo '<div class="col-sm-1"></div><div class="encart col-sm-10" style="text-align: center;">', $user->getFlash(), '</div>'; ?>
  
  
  
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
  		<td style="text-align:center"><p> <?= $art['depart'] ?>    </p></td>
  		<td style="text-align:center"> <?=  $art['arrivee']) ?>  </td>
  		
		

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



