<?php
namespace App\Backend\Modules\Articles;
 
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Articles;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \FormBuilder\ArticlesFormBuilder;
use \OCFram\FormHandler;
 
class ArticlesController extends BackController
{
  public function executeIndex(HTTPRequest $request)
  {
    //echo 'ArticlesController->executeIndex<br>';
    $this->page->addVar('title', 'Gestion des articles');
 
    $manager = $this->managers->getManagerOf('Articles');
    
    $this->page->addVar('NumberUnvalidatedComments', $manager->getNumberUnvalidatedComments());
    $this->page->addVar('listeArticles', $manager->getAllArticles());
    $this->page->addVar('nombreNews', $manager->count());
  }
  
  
  
  
  
  public function executeDelete(HTTPRequest $request)
  {
    $newsId = $request->getData('id');
 
    $this->managers->getManagerOf('Articles')->delete($newsId);
    $this->managers->getManagerOf('Comments')->deleteFromNews($newsId);
 
    $this->app->user()->setFlash('L\'article a bien été supprimée !');
 
    $this->app->httpResponse()->redirect('.');
  }
 
 
 
 
  public function executeDeleteComment(HTTPRequest $request)
  {
        
    $CommentId = $request->getData('id');
    //echo $CommentId;
    
    $articleId = $request->getData('id_article');
    echo $articleId;
    
    
    $this->managers->getManagerOf('Comments')->delete($CommentId);
 
    $this->app->user()->setFlash('Le commentaire a bien été supprimé !');
 
    $redirection = 'http://localhost/~alexei/FlyWithMeOC2/Web/admin/articles-list-comment-' . $articleId . '.html';
    //echo $redirection;

    $this->app->httpResponse()->redirect($redirection);
    
  }
 

 
 
  public function executeInsert(HTTPRequest $request)
  {
    $this->processForm($request);
 
    $this->page->addVar('title', 'Ajout d\'un article');
  }
 
 
  public function executeUpdate(HTTPRequest $request)
  {
    $this->processForm($request);
    
    $title_article = $this->managers->getManagerOf('articles')->getUnique($request->getData('id'))->titre();
    //echo 'title_article : ' . $title_article;
    $this->page->addVar('title_article', $title_article );
    
    $this->page->addVar('title', 'Modification de l\'article');
  }
 
 
  public function executeUpdateComment(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Modification d\'un commentaire');
 
    if ($request->method() == 'POST')
    {
      $comment = new Comment([
        'id' => $request->getData('id'),
        'auteur' => $request->postData('auteur'),
        'contenu' => $request->postData('contenu')
      ]);
    }
    else
    {
      $comment = $this->managers->getManagerOf('Comments')->get($request->getData('id'));
    }
 
    $formBuilder = new CommentFormBuilder($comment);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);
 
    if ($formHandler->process())
    {
      $this->app->user()->setFlash('Le commentaire a bien été modifié');
 
      $this->app->httpResponse()->redirect('/admin/');
    }
 
    $this->page->addVar('form', $form->createView());
  }
  
  
  
  public function executeValidateComment(HTTPRequest $request)
  {
    //echo 'executeValidateComment<br>';
    
    $this->page->addVar('title', 'Validation d\'un commentaire');
    
    $comment_manager = $this->managers->getManagerOf('Comments');
    $comment = $comment_manager->get($request->getData('id'));
    $id_comment = $comment->id();
    //echo '$comment->id() : ' . $comment->id() . '<br>';
    
    $comment_manager->validateCommentWithId($id_comment);
    //echo 'fin executeValidateComment<br>';
    
    $this->app->user()->setFlash('Le commentaire a bien été validé !');
 
    $this->app->httpResponse()->redirect('.');
    
  }
 
 
  public function processForm(HTTPRequest $request)
  {
    
    if ($request->method() == 'POST')
    {
      echo 'processForm POST<br>';
      $articles = new Articles([
        'titre' => $request->postData('depart'). '-' . $request->postData('arrivee'),
        'depart' => $request->postData('depart'),
        'arrivee' => $request->postData('arrivee'),
        'contenu' => $request->postData('contenu')
        
      ]);
 
      if ($request->getExists('id'))
      {
        //echo 'id : ' . $request->getData('id');
        $articles->setId($request->getData('id'));
      }
    }
    else
    {
      //echo 'pas POST<br>';
      // L'identifiant de la news est transmis si on veut la modifier
      if ($request->getExists('id'))
      {
        //echo '$request->getData(id) : ' . $request->getData('id') . '<br>';
        $articles = $this->managers->getManagerOf('articles')->getUnique($request->getData('id'));
      }
      else
      {
        //echo 'new Articles';
        $articles = new Articles;
      }
    }
 
    $formBuilder = new ArticlesFormBuilder($articles);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('articles'), $request);
 
    if ($formHandler->process())
    {
      $this->app->user()->setFlash($articles->isNew() ? 'L\'article a bien été ajouté !' : 'L\'article a bien été modifié !');
 
      $this->app->httpResponse()->redirect('/~alexei/FlyWithMeOC2/Web/admin/');
    }
 
    $this->page->addVar('form', $form->createView());
  }
  
  
  public function executeListComment(HTTPRequest $request)
  {
    //echo 'executeListComment<br>';
    $this->page->addVar('title', 'Liste des commentaires');
    
    $id_article = $request->getData('id');
    //echo $id_article;
 
    $manager = $this->managers->getManagerOf('Articles');

    
   	$this->page->addVar('listeComments', $manager->getListCommentById($id_article));
    $this->page->addVar('nombreComments', $manager->getCountCommentById($id_article));
    $this->page->addVar('title_article', $manager->getTitleById($id_article));
    $this->page->addVar('id_article', $id_article);
    
    //echo 'fin executeListComment';

  }
  
  
  public function executeListValidatedComment(HTTPRequest $request)
  {
    //echo 'executeListComment<br>';
    $this->page->addVar('title', 'Commentaires validés');
 
    $managerArticles = $this->managers->getManagerOf('Articles');
 
    $this->page->addVar('listeComments', $managerArticles->getListValidatedCommentById($request->getData('id')));
    $this->page->addVar('nombreComments', $managerArticles->getCountValidatedCommentById($request->getData('id')));
    $this->page->addVar('title_article', $managerArticles->getTitleById($request->getData('id')));
  }
  
  public function executeListUnvalidatedComment(HTTPRequest $request)
  {
    //echo 'executeListComment<br>';
    $this->page->addVar('title', 'Commentaires à valider');
 
    $managerArticles = $this->managers->getManagerOf('Articles');
 
    $this->page->addVar('listeComments', $managerArticles->getUnvalidatedComments($request->getData('id')));
    $this->page->addVar('nombreComments', $managerArticles->getCountUnvalidatedCommentById($request->getData('id')));
    $this->page->addVar('title_article', $managerArticles->getTitleById($request->getData('id')));
  }



}



























