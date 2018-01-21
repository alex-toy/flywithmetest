<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>FlyWithMe - <?= isset($title) ? $title : 'Mon super site' ?></title>

    <link rel="stylesheet" href="http://localhost/~alexei/FlyWithMeOC2/Web/css/style.css" />
    <link href="http://localhost/~alexei/FlyWithMeOC2/Web/assets/css/bootstrap.css" rel="stylesheet">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8" />
</head>


<body>




<!-- menu ====================================================-->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">FlyWithMe</a>
    </div>
    <ul class="nav navbar-nav">
    	<li><a href="http://localhost/~alexei/FlyWithMeOC2/Web/articles">Accueil</a></li>
    	<li><a href="/">Qui suis-je ?</a></li>
    	<li><a href="http://localhost/~alexei/FlyWithMeOC2/Web/allarticles">Tous les Articles</a></li>
    	<li><a href="#">Liens</a></li>
    	<li><a href="#">Me contacter</a></li>
    	<li class="active"><a href="/~alexei/FlyWithMeOC2/Web/admin/">Admin</a></li>
    </ul>
  </div>
</nav>





<div class="row">
	
	
	
	
	
	<!-- CONTENU ====================================================-->
	<div class="col-md-9">
		
		
		<section class="encart">
		<nav>
        <ul>
          
          <?php if ($user->isAuthenticated()) { ?>
			<?php echo 'user->isAuthenticated()'; ?>
          <?php } ?>
        </ul>
      </nav>
 
 
 
 
      <div id="content-wrap">
        <section id="main">
          <?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>
 
          <?= $content ?>
        </section>
      </div>
 
		
		
        
			

	</div>
	
	
	
	
	
</div>


        
<footer class="encart">
	<p>Copyright FlyWithMe - Tous droits réservés<br />
	<a href="#">Me contacter !</a></p>
</footer>	







</body>
</html>




























    	
    
   
   
   








 










