<?php if ($_SESSION['connected'] == true && !empty($_SESSION['name']) ){ ?>
	<div class="row">
		<div class="col-sm-8"></div>
			<div class="col-sm-3 encart">
				<p style="text-align: center;"  ><?= $_SESSION['name'] ?>, vous devez vous déconnecter avant de vous connecter en admin !</p>
			</div>
	</div>
				
				<?php 
				}
				else { ?>
				<section class="encart">
<h2>Se connecter</h2>
<form action="" method="post">
  <p><?=  $form ?>
 
    <br><input class="btn btn-primary" type="submit" value="Envoyer la demande de connexion" />
  </p>
</form>
</section>';

<?php
}
?>





