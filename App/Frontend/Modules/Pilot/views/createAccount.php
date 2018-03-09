<?php if ($_SESSION['connected'] == false){  ?>

<section class="encart">
<h2>Se créer un compte</h2>
<form action="" method="post">
  <p>
    
  <?= $form ?>
 
    <br><input class="btn btn-primary" type="submit" value="Envoyer la demande de création de compte" />
  </p>
</form>
</section>

<?php
}else{
 ?>

<section class="encart">Vous êtes déjà connecté</section>


<?php
}?>