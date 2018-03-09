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

  public function executeListe_articles()
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
  
  
  
  public function executeListe_all_articles()
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
    
    $article = $this->managers->getManagerOf('articles')->getUnique($request->getData('id'));
 
    if (empty($article))
    {
      $this->app->httpResponse()->redirect404();
    }
 	
    $this->page->addVar('title', $article->titre());
    $this->page->addVar('article', $article);
    $this->page->addVar('comments', $this->managers->getManagerOf('Comments')->getListOf($article->id()));
    $this->page->addVar('validatedcomments', $this->managers->getManagerOf('Comments')->getValidatedComments($article->id()));
    
    
    $manager = $this->managers->getManagerOf('Articles');
    $nombreArticles = $manager->count();
    
    $this->page->addVar('nombreArticles', $nombreArticles);
    $listeAllTitle = $manager->getAllTitle();
    ob_start();
      require __DIR__ .'/views/bandeau_lateral_titre.php';
    $bandeau_lateral = ob_get_clean();
    $this->page->addVar('bandeau_lateral', $bandeau_lateral);
 


    $nombreArticles = $manager->count();
    
    $this->page->addVar('nombreArticles', $nombreArticles);

    
  }
 
 
 
 
  public function executeInsertComment(HTTPRequest $request)
  {
    if ($request->method() == 'POST')
    {
      $comment = new Comment([
        'id_article' => $request->getData('id_article'),
        'auteur' => $_SESSION['name'],
        'contenu' => $request->postData('contenu'),
        'validated' => false
      ]);
            
    }
    else
    {
      $comment = new Comment;
    }
 
    $formBuilder = new CommentFormBuilder($comment);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);
 
    if ($formHandler->process())
    {
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
    $this->page->addVar('nombreArticles', $nombreArticles);
    $listeAllTitle = $manager->getAllTitle();
    ob_start();
      require __DIR__ .'/views/bandeau_lateral_titre.php';
    $bandeau_lateral = ob_get_clean();
    $this->page->addVar('bandeau_lateral', $bandeau_lateral);
     
	
    $id_article = $request->getData('id_article');
    $titre_article = $manager->getTitleById($id_article);
	$this->page->addVar('title_article', $titre_article[0]);
    
    
    $nombreArticles = $manager->count();
    $this->page->addVar('nombreArticles', $nombreArticles);
    
    
  }



  public function executeSearch(HTTPRequest $request)
  {
    if ($request->method() == 'POST')
    {
		$manager = $this->managers->getManagerOf('Articles');
		$list_departures = $manager->getDepartures();
		$this->page->addVar('departures', $list_departures);
		
		
		
		$list_arrivals = $manager->getArrivals();
		$this->page->addVar('arrivals', $list_arrivals);
		
      
		$idArtCorrespondant = $manager->getArticlesByDepartureAndArrival($_POST['depart'], $_POST['arrivee']);
		$article = [];
		foreach($idArtCorrespondant as $id)
		{
			$article[] = $manager->getUnique($id);
		}
		$this->page->addVar('article', $article);
      
    }
    else
    {
		$manager = $this->managers->getManagerOf('Articles');
		$list_departures = $manager->getDepartures();
		$this->page->addVar('departures', $list_departures);
		
		$list_arrivals = $manager->getArrivals();
		$this->page->addVar('arrivals', $list_arrivals);
    }
 

    $manager = $this->managers->getManagerOf('Articles');
    $nombreArticles = $manager->count();
    
    $this->page->addVar('nombreArticles', $nombreArticles);
    $listeAllTitle = $manager->getAllTitle();
    ob_start();
      require __DIR__ .'/views/bandeau_lateral_titre.php';
    $bandeau_lateral = ob_get_clean();
    $this->page->addVar('bandeau_lateral', $bandeau_lateral);
 

  }
  
  
  public function executeWhoamI()
  {

    $this->page->addVar('title', 'qui je suis?');
    
    $manager = $this->managers->getManagerOf('Articles');
    $nombreArticles = $manager->count();
    
    $this->page->addVar('nombreArticles', $nombreArticles);
    $listeAllTitle = $manager->getAllTitle();
    ob_start();
      require __DIR__ .'/views/bandeau_lateral_titre.php';
    $bandeau_lateral = ob_get_clean();
    $this->page->addVar('bandeau_lateral', $bandeau_lateral);

  }
  
  
  
  

}















