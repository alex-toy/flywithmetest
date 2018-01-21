<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>FlyWithMe - <?= $title ?></title>

    <link rel="stylesheet" href="http://localhost/~alexei/FlyWithMeOC2/Web/css/style.css" />
    <link href="http://localhost/~alexei/FlyWithMeOC2/Web/assets/css/bootstrap.css" rel="stylesheet">
    
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8" />
    
    </style>
  		<script src="https://code.jquery.com/jquery-1.10.2.js">
  	</script>
  	
  	<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  	<script>tinymce.init({ selector:'textarea' });</script>

    
</head>


<body>




<!-- menu ====================================================-->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">FlyWithMe</a>
    </div>
    <ul class="nav navbar-nav">
      	<li class="active"><a href="http://localhost/~alexei/FlyWithMeOC2/Web/articles">Accueil</a></li>
      	<li><a href="/">Qui suis-je ?</a></li>
      	<li><a href="http://localhost/~alexei/FlyWithMeOC2/Web/allarticles">Tous les articles</a></li>
      	<li><a href="#">Liens</a></li>
       <li><a href="#">Me contacter</a></li>
       <li><a href="http://localhost/~alexei/FlyWithMeOC2/Web/search">Recherche</a></li>
       <li><a href="http://localhost/~alexei/FlyWithMeOC2/Web/admin/">Admin</a></li>
    </ul>
  </div>
</nav>





<div class="row">
	
	
	<!-- bandeau latéral ====================================================-->
	<div class="col-md-3">
		<section class="encart bandeau_lateral">
		
			<h2>Liste des <?= $nombreArticles ?> articles disponibles : </h2>
			<?= $listeAllTitle ?>
			
        </section>
	</div>
	
	
	<!-- CONTENU ====================================================-->
	<div class="col-md-9">
		
		
		<!-- titre global ================================================== -->
		<?= $titre_global ?>
		
        <!-- test Jquery -->
		<!-- <div class="encart all"></div> -->
        
        
        <!-- articles ================================================== -->
		<?= $content ?>
		
		
		<!-- getFlash ================================================== -->

		<div id="content-wrap">
        <section id="main">
			<?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>
        </section>
      </div>
		
		
		<!-- <textarea>Next, start a free trial!</textarea> -->
			
			

	</div>
	
	
	
	
	
</div>













        
<footer class="encart">
	<p>Copyright FlyWithMe - Tous droits réservés<br />
	<a href="#">Me contacter !</a></p>
</footer>	





<script type="text/javascript" src="http://localhost/~alexei/FlyWithMeOC2/Web/process.js"></script>  
<script src="http://localhost/~alexei/FlyWithMeOC2/Web/jquery.js"></script>

</body>
</html>




























    	
    
   
   
   
   
   
    


 





























   