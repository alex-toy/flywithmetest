<?php
namespace App\Frontend\Modules\Articles;


use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Comment;
use \Entity\Articles;
use \Entity\User;
use \FormBuilder\CommentFormBuilder;
use \FormBuilder\SearchFormBuilder;
use \OCFram\FormHandler;

 
class ArticlesController extends BackController
{

  public function executeListe_articles(HTTPRequest $request)
  {
    $this->page->addVar('title', 'accueil');
    
    
    $nombreArticles = $this->app->config()->get('nombre_news');
    $nombreCaracteres = $this->app->config()->get('nombre_caracteres');
    
    
    $manager = $this->managers->getManagerOf('Articles');
 	
 	
 	
 	$listeArticles = $manager->getList(0, $nombreArticles);
    foreach ($listeArticles as $art)
    {
      if (strlen($art->contenu()) > $nombreCaracteres)
      {
        $debut = substr($art->contenu(), 0, $nombreCaracteres);
        $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
        
        $art->setContenu($debut);
      }
    }
    $this->page->addVar('listeArticles', $listeArticles);
    
    
    //bandeau lateral :
    $nombreArticles = $manager->count();
    $this->page->addVar('nombreArticles', $nombreArticles);
    $listeAllTitle = $manager->getAllTitle();
    ob_start();
      require __DIR__ .'/views/bandeau_lateral_titre.php';
    $bandeau_lateral = ob_get_clean();
    $this->page->addVar('bandeau_lateral', $bandeau_lateral);
    
 

    ob_start();
      require __DIR__ .'/views/titre_global.html';
    $titre_global = ob_get_clean();
    $this->page->addVar('titre_global', $titre_global);
  
  }
  
  
  
  public function executeListe_all_articles(HTTPRequest $request)
  {
    
    $nombreCaracteres = $this->app->config()->get('nombre_caracteres');
    
    $this->page->addVar('title', 'accueil');
    
    $manager = $this->managers->getManagerOf('Articles');
 	$listeArticles = $manager->getAllArticles();
 	foreach ($listeArticles as $art)
    {
      if (strlen($art->contenu()) > $nombreCaracteres)
      {
        $debut = substr($art->contenu(), 0, $nombreCaracteres);
        $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
        
        $art->setContenu($debut);
      }
    }
    
    
    $this->page->addVar('listeArticles', $listeArticles);
    
    
    $nombreArticles = $manager->count();
    $this->page->addVar('nombreArticles', $nombreArticles);
    
    
    
    $listeAllTitle = $manager->getAllTitle();
    ob_start();
      require __DIR__ .'/views/bandeau_lateral_titre.php';
    $bandeau_lateral = ob_get_clean();
    $this->page->addVar('bandeau_lateral', $bandeau_lateral);
    
  
  }
  
  
 
  public function executeShowArticleById(HTTPRequest $request)
  {
    //echo 'executeShowArticleById <br>';
    
    $article = $this->managers->getManagerOf('articles')->getUnique($request->getData('id'));
 
    if (empty($article))
    {
      $this->app->httpResponse()->redirect404();
    }
 	
    $this->page->addVar('title', $article->titre());
    $this->page->addVar('article', $article);
    $this->page->addVar('comments', $this->managers->getManagerOf('Comments')->getListOf($article->id()));
    $this->page->addVar('validatedcomments', $this->managers->getManagerOf('Comments')->getValidatedComments($article->id()));
    
    
    //bandeau lateral :
    $manager = $this->managers->getManagerOf('Articles');
    $nombreArticles = $manager->count();
    //echo 'nombreArticles : ' . $nombreArticles . '<br>';
    $this->page->addVar('nombreArticles', $nombreArticles);
    $listeAllTitle = $manager->getAllTitle();
    ob_start();
      require __DIR__ .'/views/bandeau_lateral_titre.php';
    $bandeau_lateral = ob_get_clean();
    $this->page->addVar('bandeau_lateral', $bandeau_lateral);
 

    
    // On ajoute la variable $nombreArticles à la vue.
    $nombreArticles = $manager->count();
    //echo 'nombreArticles : ' . $nombreArticles . '<br>';
    $this->page->addVar('nombreArticles', $nombreArticles);
    
	$id = $request->getData('id');
	//echo 'id : ' . $id;
    
  }
 
 
 
 
  public function executeInsertComment(HTTPRequest $request)
  {
    //echo 'executeInsertComment <br>';
    // Si le formulaire a été envoyé.
    if ($request->method() == 'POST')
    {
      //echo 'POST<br>';
      $comment = new Comment([
        'id_article' => $request->getData('id_article'),
        //'id_pilot' => 1,
        //'id_pilot' => $request->getData('id_pilot'),
        'auteur' => $_SESSION['name'],
        'contenu' => $request->postData('contenu'),
        'validated' => false
      ]);
            
    }
    else
    {
      //echo 'new comment <br>';
      $comment = new Comment;
    }
 
    $formBuilder = new CommentFormBuilder($comment);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);
 
    if ($formHandler->process())
    {
      //echo '$formHandler->process() : <br>'; 
      $this->app->user()->setFlash(ucfirst($_SESSION['name']) . ', votre commentaire va être prochainement validé ! Merci !');
 
      $this->app->httpResponse()->redirect('articles-'.$request->getData('id_article').'.html');
    }
 
    $this->page->addVar('comment', $comment);
    $this->page->addVar('form', $form->createView());
    $this->page->addVar('title', 'Ajout d\'un commentaire');
    
    $manager = $this->managers->getManagerOf('Articles');
     
     //bandeau lateral :
    $manager = $this->managers->getManagerOf('Articles');
    $nombreArticles = $manager->count();
    //echo 'nombreArticles : ' . $nombreArticles . '<br>';
    $this->page->addVar('nombreArticles', $nombreArticles);
    $listeAllTitle = $manager->getAllTitle();
    ob_start();
      require __DIR__ .'/views/bandeau_lateral_titre.php';
    $bandeau_lateral = ob_get_clean();
    $this->page->addVar('bandeau_lateral', $bandeau_lateral);
     
	
	//Variable pour le titre de l'article à commenter :
    $id_article = $request->getData('id_article');
    //echo 'id_article : ' . $id_article . '<br>';
    $titre_article = $manager->getTitleById($id_article);
	//echo 'titre_article : ' . $titre_article[0];
	$this->page->addVar('title_article', $titre_article[0]);
    
    
    // On ajoute la variable $nombreArticles à la vue.
    $nombreArticles = $manager->count();
    //echo 'nombreArticles : ' . $nombreArticles . '<br>';
    $this->page->addVar('nombreArticles', $nombreArticles);
    
    
  }



  public function executeSearch(HTTPRequest $request)
  {
    //echo 'articlesController->executeSearch <br>';
    
    
    // Si le formulaire a été envoyé.
    if ($request->method() == 'POST')
    {
		//echo 'POST<br>';
      
		//echo 'recherche des départs<br>';
		$manager = $this->managers->getManagerOf('Articles');
		$list_departures = $manager->getDepartures();
		$this->page->addVar('departures', $list_departures);
		//print_r($list_departures);
		
		//echo 'recherche des arrivées<br>';
		$list_arrivals = $manager->getArrivals();
		$this->page->addVar('arrivals', $list_arrivals);
		//print_r($list_arrivals);
      
		// trouver les aricles correspondant au départ et a l'arrivée :      
		//echo 'depart : ' . $_POST['depart'] . '<br>';
		//echo 'arrivée : ' . $_POST['arrivee'] . '<br>';
		$idArticleCorrespondant = $manager->getArticlesByDepartureAndArrival($_POST['depart'], $_POST['arrivee']);
		//print_r($idArticleCorrespondant);
		$article = [];
		foreach($idArticleCorrespondant as $id)
		{
			//echo $id;
			$article[] = $manager->getUnique($id);
			
		}
		//print_r($article);
		$this->page->addVar('article', $article);
      
    }
    else
    {
		//echo 'recherche des départs<br>';
		$manager = $this->managers->getManagerOf('Articles');
		$list_departures = $manager->getDepartures();
		$this->page->addVar('departures', $list_departures);
		//print_r($list_departures);
		
		//echo 'recherche des arrivées<br>';
		$list_arrivals = $manager->getArrivals();
		$this->page->addVar('arrivals', $list_arrivals);
		//print_r($list_arrivals);
    }
 
    

    //bandeau lateral :
    $manager = $this->managers->getManagerOf('Articles');
    $nombreArticles = $manager->count();
    //echo 'nombreArticles : ' . $nombreArticles . '<br>';
    $this->page->addVar('nombreArticles', $nombreArticles);
    $listeAllTitle = $manager->getAllTitle();
    ob_start();
      require __DIR__ .'/views/bandeau_lateral_titre.php';
    $bandeau_lateral = ob_get_clean();
    $this->page->addVar('bandeau_lateral', $bandeau_lateral);
 

  }
  
  
  public function executeWhoamI(HTTPRequest $request)
  {
    //echo 'articlesController->executeWhoamI <br>';
    
    //variable pour le titre du bandeau :
    $this->page->addVar('title', 'qui je suis?');
    
    //$test = this->SideStrip();
    
    
    //bandeau lateral :
    $manager = $this->managers->getManagerOf('Articles');
    $nombreArticles = $manager->count();
    //echo 'nombreArticles : ' . $nombreArticles . '<br>';
    $this->page->addVar('nombreArticles', $nombreArticles);
    $listeAllTitle = $manager->getAllTitle();
    ob_start();
      require __DIR__ .'/views/bandeau_lateral_titre.php';
    $bandeau_lateral = ob_get_clean();
    $this->page->addVar('bandeau_lateral', $bandeau_lateral);

  }
  
  
  
  

}















