<section class="encart">
<h4>Paramètres de la recherche :</h4>

<form method="post">



<aside class="col-lg-4 class="dropdown"">
		<label>Départ :</label><br />
							   
		<select name="depart">
		<?php   
		foreach ($departures as $value)
		{
		?>
			<option value="<?= $value ?>"><?=  $value ?></option>
		<?php
		}
		?>		
		</select>
</aside>


<aside class="col-lg-4">
		<label>Arrivée :</label><br />
							   
		<select name="arrivee">
		<?php
		foreach ($arrivals as $value)
		{
		?>
			<option value="<?= $value ?>"><?=  $value ?></option>
		<?php
		}
		?>
		</select>
</aside>



<input class="btn btn-primary" type="submit" value="Effectuer la recherche" />

</form>	

<!-- espace en bas -->
<div><br></div>

</section>





<?php
if(isset($article))
{      ?>
<section class="encart">
<h4>Résultats de la recherche :</h4>

	<?php
	foreach ($article as $value)
	{?>    
		
		<p><a href="articles-<?= $value['id'] ?>.html">   <?= $value['depart'] ?> - <?= $value['arrivee'] ?> à la date du <?= $value['dateAjout']->format('d/m/Y à H\hi') ?>   </a>  </p>
		
		
	<?php
	}
	?>


<!-- espace en bas -->
<div><br></div>





</section>

<?php
}
?>




<aside style="text-align:right;" >
		<a href="http://localhost/~alexei/FlyWithMeOC2/Web/search" class="btn btn-primary" role="button">Réinitialiser la recherche</a>
</aside>












