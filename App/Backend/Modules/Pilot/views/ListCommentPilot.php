<section class="encart">
<h3>Commentaires de <?= $pilotname ?></h3>
</section>


<section class="encart">
<table class="table table-condensed">
  <thead>
      <tr>
        <th style="text-align:center">titre article</th>
        <th style="text-align:center">date du commentaire</th>
        <th style="text-align:center">commentaire</th>
        <th style="text-align:center">validation</th>
      </tr>
    </thead><tbody>
<?php
foreach ($AllCommentsFromPilotName as $comment)
{
?>
	<tr>
  		<td style="text-align:center"><?= $comment['title'] ?></td>
  		<td style="text-align:center"><?= $comment['date'] ?></td>
  		<td style="text-align:center"><?= $comment['content'] ?></td>
  		<td style="text-align:center"><?= ($comment['validation']==1)?'oui':'non' ?></td>
	</tr>

<?php
}
?>
</tbody></table>

</section>

<section class="encart">		
<p><a class="btn btn-primary" href="/~alexei/FlyWithMeOC2/Web/admin/pilotes/">Retourner à la liste des pilotes</a></p>		
</section>	



		
			
			
			
        
        