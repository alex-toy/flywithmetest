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

//use \OCFram\Smarty.php;
 
class ArticlesController extends BackController
{

  public function executeListe_articles(HTTPRequest $request)
  {
    echo 'articlesController->executeListe_articles <br>';
    
    $nombreArticles = $this->app->config()->get('nombre_news');
    $nombreCaracteres = $this->app->config()->get('nombre_caracteres');
    //echo 'nombreNews : ' . $nombreArticles . '<br>';
    //echo 'nombreCaracteres : ' . $nombreCaracteres . '<br>';
    
    //variable pour le titre du bandeau :
    $this->page->addVar('title', 'accueil');
    
    // On récupère le manager des articles.
    //echo 'getManagerOf(Articles) : ';
    $manager = $this->managers->getManagerOf('Articles');
 	$listeArticles = $manager->getList(0, $nombreArticles);
    //echo 'listeArticles[0]->titre() : ' . $listeArticles[0]->titre() . '<br>';
    
    
    // On ajoute la variable $listeArticles à la vue.
    $this->page->addVar('listeArticles', $listeArticles);
    
    
    //Variable pour les titres :
    $listeAllTitle = $manager->getAllTitle();
    ob_start();
      require __DIR__ .'/views/bandeau_lateral_titre.php';
    $listeAllTitle = ob_get_clean();
    $this->page->addVar('listeAllTitle', $listeAllTitle);
    
 

    
    // On ajoute la variable $nombreArticles à la vue.
    $nombreArticles = $manager->count();
    //echo 'nombreArticles : ' . $nombreArticles . '<br>';
    $this->page->addVar('nombreArticles', $nombreArticles);
    
    
    
    // variable pour le titre et le carousel :
    ob_start();
      require __DIR__ .'/views/titre_global.html';
    $titre_global = ob_get_clean();
    $this->page->addVar('titre_global', $titre_global);
  
  }
  
  
  
  public function executeListe_all_articles(HTTPRequest $request)
  {
    //echo 'articlesController->executeListe_articles <br>';
    
    
    $nombreCaracteres = $this->app->config()->get('nombre_caracteres');
    //echo 'nombreCaracteres : ' . $nombreCaracteres . '<br>';
    
    //variable pour le titre du bandeau :
    $this->page->addVar('title', 'accueil');
    
    // On récupère le manager des articles.
    //echo 'getManagerOf(Articles) : ';
    $manager = $this->managers->getManagerOf('Articles');
 	$listeArticles = $manager->getAllArticles();
    //echo 'listeArticles[0]->titre() : ' . $listeArticles[0]->titre() . '<br>';
    
    
    // On ajoute la variable $listeArticles à la vue.
    $this->page->addVar('listeArticles', $listeArticles);
    
    
    //Variable pour les titres :
    $listeAllTitle = $manager->getAllTitle();
    //echo 'listeAllTitle[0]->titre() : ' . $listeAllTitle[0]['id'] . '<br>';
    ob_start();
      require __DIR__ .'/views/bandeau_lateral_titre.php';
    $listeAllTitle = ob_get_clean();
    $this->page->addVar('listeAllTitle', $listeAllTitle);
 

    
    // On ajoute la variable $nombreArticles à la vue.
    $nombreArticles = $manager->count();
    //echo 'nombreArticles : ' . $nombreArticles . '<br>';
    $this->page->addVar('nombreArticles', $nombreArticles);
    
  
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
    
    
    //Variable pour les titres :
    $manager = $this->managers->getManagerOf('Articles');
    $listeAllTitle = $manager->getAllTitle();
    //echo 'listeAllTitle[0]->titre() : ' . $listeAllTitle[0]['id'] . '<br>';
    ob_start();
      require __DIR__ .'/views/bandeau_lateral_titre.php';
    $listeAllTitle = ob_get_clean();
    $this->page->addVar('listeAllTitle', $listeAllTitle);
 

    
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
        'auteur' => $request->postData('auteur'),
        'contenu' => $request->postData('contenu'),
        'validated' => false
      ]);
      
      //echo 'setFlash<br>';
      $this->app->user()->setFlash('Le commentaire va être prochainement validé !');
      
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
      $this->app->user()->setFlash('Le commentaire a bien été ajouté, merci !');
 
      $this->app->httpResponse()->redirect('articles-'.$request->getData('id_article').'.html');
    }
 
    $this->page->addVar('comment', $comment);
    $this->page->addVar('form', $form->createView());
    $this->page->addVar('title', 'Ajout d\'un commentaire');
    
    $manager = $this->managers->getManagerOf('Articles');
     
     //Variable pour les titres du bandeau latéral :
    $listeAllTitle = $manager->getAllTitle();
    //echo 'listeAllTitle[0]->titre() : ' . $listeAllTitle[0]['titre'] . '<br>';
    ob_start();
      require __DIR__ .'/views/bandeau_lateral_titre.php';
    $listeAllTitle = ob_get_clean();
    $this->page->addVar('listeAllTitle', $listeAllTitle);
 
	
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
 
    
   
     
     //Variable pour les titres du bandeau latéral :
	$manager = $this->managers->getManagerOf('Articles');
    $listeAllTitle = $manager->getAllTitle();
    //echo 'listeAllTitle[0]->titre() : ' . $listeAllTitle[0]['titre'] . '<br>';
    ob_start();
      require __DIR__ .'/views/bandeau_lateral_titre.php';
    $listeAllTitle = ob_get_clean();
    $this->page->addVar('listeAllTitle', $listeAllTitle);
 
	

  
  }


}















