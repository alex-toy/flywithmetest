<div class="row">
<div class="col-sm-1"></div>
<div class="encart col-sm-10">


<?php
if($nombreComments == 0)
{
?>
<h2 style="text-align:left">Il n'y a actuellement aucun commentaire à valider sur l'article <?= $title_article[0] ?>.</h2>
<?php
}
else if($nombreComments == 1)
{
?>
<h2 style="text-align:left">Il y a actuellement 1 commentaire à valider sur l'article <?= $title_article[0] ?></h2>
<?php
}
else if($nombreComments > 1)
{
?>
<h2 style="text-align:left">Il y a actuellement <?= $nombreComments ?> commentaires à valider sur l'article <?= $title_article[0] ?>. En voici la liste :</h2>
<?php
}
?>
<table class="table table-condensed">
  <thead>
      <tr>
        <th style="text-align:center">auteur</th>
        <th style="text-align:center">contenu</th>
        <th style="text-align:center">date de création du commentaire</th>
        <th style="text-align:center">Valider</th>
        <th style="text-align:center">Supprimer</th>
      </tr>
    </thead><tbody>
<?php
foreach ($listeComments as $comment)
{
?>
  <tr>
  		<td style="text-align:center"><?= $comment['auteur'] ?></td>
  		<td style="text-align:center"><?= $comment['contenu'] ?></td>
  		<td style="text-align:center"><?= $comment['date'] ?></td>
		<td style="text-align:center"><INPUT onclick="GatherIdsToValidate(<?= $comment['id'] ?>)" type="checkbox" name="choix1" value="1"></td>
		<td style="text-align:center"><INPUT onclick="GatherIdsToDelete(<?= $comment['id'] ?>)" type="checkbox" name="choix1" value="1"></td>
		
	</tr>
<?php
}
?>

<td></td><td></td><td></td>
<td><p onclick="ValidateGroup(<?= $id_article ?>)"><a class="btn btn-primary" >Valider</a></p></td>
<td><p onclick="DeleteGroup(<?= $id_article ?>)"><a class="btn btn-primary" >Supprimer</a></p></td>


</tbody></table>





<p><a class="btn btn-primary" href="/~alexei/FlyWithMeOC2/Web/admin/">Retourner à la liste des articles</a></p>


</div>
</div>



<script>
function DeleteGroup(idArticle) {
	
	//alert(idArticle);
	//alert(CommentsIdsToBeDeleted_temp);
	
	var CommentsIdsToBeDeleted = "[";

	
	for(id in CommentsIdsToBeDeleted_temp) {CommentsIdsToBeDeleted += CommentsIdsToBeDeleted_temp[id]+',';}
	CommentsIdsToBeDeleted = CommentsIdsToBeDeleted.substring(0,CommentsIdsToBeDeleted.length-1)
	CommentsIdsToBeDeleted = CommentsIdsToBeDeleted.concat(']');
	
	//alert(CommentsIdsToBeDeleted);
	
	if (confirm("êtes vous sûr de vouloir supprimer ces commentaires ?")) { 
		var redirect = "http://localhost/~alexei/FlyWithMeOC2/Web/admin/unvalidatedGroupcomment-delete-" + CommentsIdsToBeDeleted + "-" + idArticle  + ".html"; 
		//alert(redirect);
		document.location.href=redirect; 	
	}
	
	
}


var CommentsIdsToBeDeleted_temp = [];



function GatherIdsToDelete(idComment) {

	//alert('GatherIdsToDelete : ' + idComment);
	
	if(!CommentsIdsToBeDeleted_temp.includes(idComment)){ 
		//alert('insérer le comment : ' + idComment);
		CommentsIdsToBeDeleted_temp.push(idComment);
	}
	else{
		//alert('retirer le comment ' + idComment);
		var indeexOfComment = CommentsIdsToBeDeleted_temp.indexOf(idComment);
		CommentsIdsToBeDeleted_temp.splice(indeexOfComment, 1);
	}
	//alert('ok');
	//alert( CommentsIdsToBeDeleted_temp );
	
}




function ValidateGroup(idArticle) {
	
	var CommentsIdsToBeValidated = "[";

	for(id in CommentsIdsToBeValidated_temp) {CommentsIdsToBeValidated += CommentsIdsToBeValidated_temp[id]+',';}
	CommentsIdsToBeValidated = CommentsIdsToBeValidated.substring(0,CommentsIdsToBeValidated.length-1)
	CommentsIdsToBeValidated = CommentsIdsToBeValidated.concat(']');
	
	if (confirm("êtes vous sûr de vouloir valider ces commentaires ?")) {
		var redirect = "http://localhost/~alexei/FlyWithMeOC2/Web/admin/unvalidatedGroupcomment-validate-" + CommentsIdsToBeValidated + "-" + idArticle  + ".html"; 
		document.location.href=redirect; 	
	}
}


var CommentsIdsToBeValidated_temp = [];



function GatherIdsToValidate(idComment) {
	
	if(!CommentsIdsToBeValidated_temp.includes(idComment)){ 
		CommentsIdsToBeValidated_temp.push(idComment);
	}
	else{
		
		var indeexOfComment = CommentsIdsToBeValidated_temp.indexOf(idComment);
		CommentsIdsToBeValidated_temp.splice(indeexOfComment, 1);
	}
	
}
</script>





















