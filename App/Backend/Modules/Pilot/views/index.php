<h2 class="encart">Liste des pilotes enregistrés </h2>


<section class="encart">
<table class="table table-condensed">
  <thead>
      <tr>
        <th style="text-align:center">nom</th>
        <th style="text-align:center">email</th>
        <th style="text-align:center">supprimer</th>
        <th style="text-align:center">commentaires</th>
      </tr>
    </thead><tbody>
<?php
foreach ($listePilotes as $pilotes)
{
	echo 
	'<tr>
  		<td style="text-align:center">', htmlspecialchars($pilotes['pilotname']), '</td>
  		<td style="text-align:center">', htmlspecialchars($pilotes['email']), '</td>
  		<td style="text-align:center"><a href="/~alexei/FlyWithMeOC2/Web/admin/pilot-delete-', htmlspecialchars($pilotes['id']) ,'.html"><img src="/~alexei/FlyWithMeOC2/Web/images/listcomment.png" width="50" alt="Supprimer" /></a></td>
		<td style="text-align:center"><a class="btn btn-primary" href="/~alexei/FlyWithMeOC2/Web/admin/pilot-listComment-', htmlspecialchars($pilotes['pilotname']), '.html">' , $CountCommentsFromPilotName[$pilotes['pilotname']] , '</a></td>
	</tr>';

}
?>
</tbody></table>

</section>

<section class="encart">		
<p><a class="btn btn-primary" href="/~alexei/FlyWithMeOC2/Web/admin/">Retourner à la liste des articles</a></p>		
</section>		
			
			
        
        




