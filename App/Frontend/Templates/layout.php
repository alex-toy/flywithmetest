<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>FlyWithMe - <?= $title ?> <?= $welcome ?></title>

    <link rel="stylesheet" href="http://localhost/~alexei/FlyWithMeOC2/Web/css/style.css" />
    
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
    
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8" />
    
</head>


<body>




<!-- menu ====================================================-->
<nav class="navbar navbar-inverse menu">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" >FlyWithMe</a>
    </div>
    <ul class="nav navbar-nav">
      	<li class="active"><a href="http://localhost/~alexei/FlyWithMeOC2/Web/articles">Accueil</a></li>
      	<li><a href="http://localhost/~alexei/FlyWithMeOC2/Web/WhoamI">Qui suis-je ?</a></li>
      	<li><a href="http://localhost/~alexei/FlyWithMeOC2/Web/allarticles">Tous les articles</a></li>
      	<li><a href="http://localhost/~alexei/FlyWithMeOC2/Web/Link">Liens</a></li>
       	<li><a href="http://localhost/~alexei/FlyWithMeOC2/Web/Contact">Me contacter</a></li>
       	<li><a href="http://localhost/~alexei/FlyWithMeOC2/Web/search">Recherche</a></li>
       	<li><a href="http://localhost/~alexei/FlyWithMeOC2/Web/createAccount">Créer un compte</a></li>
       	<li><a href="http://localhost/~alexei/FlyWithMeOC2/Web/connect">Se connecter</a></li>
       	<li><a href="http://localhost/~alexei/FlyWithMeOC2/Web/admin/">Admin</a></li>
    </ul>
  </div>
</nav>





<div class="container-fluid">
	
	
	<!-- bandeau latéral ====================================================-->
	<?= $bandeau_lateral ?>
			
       
	
	
	<!-- CONTENU ====================================================-->
	<div class="col-md-9">
		
		<!-- bienvenue de connexion ================================================== -->
		<?php if ($_SESSION['connected'] == true && $_SESSION['name'] == "admin"){ ?>
				<div class="row">
					<div class="col-sm-8"></div>
						<div class="col-sm-3 encart">
							<p style="text-align: center;"  >Bienvenue <?= $_SESSION['name'] ?> !</p>
							<a class="btn btn-primary" href="/~alexei/FlyWithMeOC2/Web/admin/DisconnectAdmin/">deconnexion</a></p>
						</div>
				</div>
				<?php
				}
				else if ($_SESSION['connected'] == true){  ?>
				<div class="row">
					<div class="col-sm-8"></div>
						<div class="col-sm-3 encart">
							<p style="text-align: center;"  >Bienvenue <?= ucfirst($_SESSION['name'])  ?> !</p>
							<a class="btn btn-primary" href="/~alexei/FlyWithMeOC2/Web/disconnect">deconnexion</a></p>
						</div>
				</div>
				<?php
				}
				?>
		
		
		
		
		<!-- titre global ================================================== -->
		<?= $titre_global ?>
		
        
        
        <!-- articles ================================================== -->
		<?= $content ?>
		
		
		
		<!-- getFlash ================================================== -->
		<?php if ($user->hasFlash()) echo '
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-10">
			<p style="text-align: center;"  class="encart">', $user->getFlash(), '</p>
			</div>
		</div>'; ?>
		
		
		
		
	</div>
	
	
	
	
	
</div>




        
<footer class="footer encart">
	<p>Copyright FlyWithMe - Tous droits réservés<br />
</footer>	



<script src="http://localhost/~alexei/FlyWithMeOC2/Web/jquery.js"></script>
<script src="http://localhost/~alexei/FlyWithMeOC2/Web/effect.js"></script>
<script src="http://localhost/~alexei/FlyWithMeOC2/Web/tinymce/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>



</body>
</html>




























    	
    
   
   
   
   
   
    


 





























   