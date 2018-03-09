<?php if ($_SESSION['connected'] == true && $_SESSION['name'] != 'admin' ){ ?>
	<div class="row">
		<div class="col-sm-8"></div>
			<div class="col-sm-3 encart">
				<p style="text-align: center;"  ><?= $_SESSION['name'] ?>, vous devez vous déconnecter avant de vous connecter en admin !</p>
			</div>
	</div>
	
<?php }else { ?>

<div class="row">
  
  <div class="col-sm-3"></div>
  
  <div class="encart col-sm-8">

<h2>Connexion en administrateur</h2>
 
<form action="" method="post">
  <label>Pseudo</label>
  <input type="text" name="login" /><br />
 
  <label>Mot de passe</label>
  <input type="password" name="password" /><br /><br />
 
  <input type="submit" value="Connexion" />
</form>
 
</div>
  
  
  
  
</div>

<?php 
}
?>




