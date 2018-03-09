<?php
namespace App\Backend\Modules\Articles;
 
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Articles;
use \OCFram\User;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \FormBuilder\ArticlesFormBuilder;
use \OCFram\FormHandler;
 
class ArticlesController extends BackController
{
  
  public function executeIndex()
  {
    
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
    
    $articleId = $request->getData('id_article');
    
    
    $this->managers->getManagerOf('Comments')->delete($CommentId);
 
    $this->app->user()->setFlash('Le commentaire a bien été supprimé !');
 
    $redirection = 'http://localhost/~alexei/FlyWithMeOC2/Web/admin/articles-list-comment-' . $articleId . '.html';
    

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
    
    $this->page->addVar('title_article', $title_article );
    
    $this->page->addVar('title', 'Modification de l\'article');
  }
  
  
  
  public function executeValidateComment(HTTPRequest $request)
  {
    
    $CommentId = $request->getData('id');
    
    $articleId = $request->getData('id_article');
    
    
    $this->page->addVar('title', 'Validation d\'un commentaire');
    
    $comment_manager = $this->managers->getManagerOf('Comments');
    
    
    $comment_manager->validateCommentWithId($CommentId);
    
    $this->app->user()->setFlash('Le commentaire a bien été validé !');
 
    $redirection = 'http://localhost/~alexei/FlyWithMeOC2/Web/admin/articles-list-unvalidated-comment-' . $articleId . '.html';

    $this->app->httpResponse()->redirect($redirection);
    
  }
  
 
 
  public function processForm(HTTPRequest $request)
  {
    
    if ($request->method() == 'POST')
    {
      $articles = new Articles([
        'titre' => $request->postData('depart'). '-' . $request->postData('arrivee'),
        'depart' => $request->postData('depart'),
        'arrivee' => $request->postData('arrivee'),
        'contenu' => $request->postData('contenu')
        
      ]);
 
      if ($request->getExists('id'))
      {
        $articles->setId($request->getData('id'));
      }
    }
    else
    {
      if ($request->getExists('id'))
      {
        $articles = $this->managers->getManagerOf('articles')->getUnique($request->getData('id'));
      }
      else
      {
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
    
    $this->page->addVar('title', 'Liste des commentaires');
    
    $id_article = $request->getData('id');
 
    $manager = $this->managers->getManagerOf('Articles');

    
   	$this->page->addVar('listeComments', $manager->getListCommentById($id_article));
    $this->page->addVar('nombreComments', $manager->getCountCommentById($id_article));
    $this->page->addVar('title_article', $manager->getTitleById($id_article));
    $this->page->addVar('id_article', $id_article);

  }
  
  
  
  public function executeListValidatedComment(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Commentaires validés');
 
    $managerArticles = $this->managers->getManagerOf('Articles');
 
    $this->page->addVar('listeComments', $managerArticles->getListValidatedCommentById($request->getData('id')));
    $this->page->addVar('nombreComments', $managerArticles->getCountValidatedCommentById($request->getData('id')));
    $this->page->addVar('title_article', $managerArticles->getTitleById($request->getData('id')));
  }
  
  
  
  public function executeListUnvalidatedComment(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Commentaires à valider');
 
    $managerArticles = $this->managers->getManagerOf('Articles');
 
    $this->page->addVar('listeComments', $managerArticles->getUnvalidatedComments($request->getData('id')));
    $this->page->addVar('nombreComments', $managerArticles->getCountUnvalidatedCommentById($request->getData('id')));
    $this->page->addVar('title_article', $managerArticles->getTitleById($request->getData('id')));
    $this->page->addVar('id_article', $request->getData('id'));
  }
  
  
  
  public function executeDeleteUnvalidatedComment(HTTPRequest $request)
  {
        
    $CommentId = $request->getData('id');
    
    
    $articleId = $request->getData('id_article');
    
    
    $this->managers->getManagerOf('Comments')->delete($CommentId);
 
    $this->app->user()->setFlash('Le commentaire a bien été supprimé !');
 
    $redirection = 'http://localhost/~alexei/FlyWithMeOC2/Web/admin/articles-list-unvalidated-comment-' . $articleId . '.html';

    $this->app->httpResponse()->redirect($redirection);
    
  }
  
  
  
  
  public function executeDeleteUnvalidatedGroupComment(HTTPRequest $request)
  {
    
    $CommentsIdsToDelete = $request->getData('CommentsIdsToBeDeleted');
    $CommentsIdsToDelete = substr($CommentsIdsToDelete, 1, $CommentsIdsToDelete.length - 1);
	
	$ComIdsToDeleteArray = explode(",",$CommentsIdsToDelete);
    
    
    
    $id_article = $request->getData('id_article');
    
    foreach ($ComIdsToDeleteArray as $CommentsId) {
    	$this->managers->getManagerOf('Comments')->delete($CommentsId);
	}
    
    $this->app->user()->setFlash('Les commentaires ont bien été supprimés !');
    $redirection = 'http://localhost/~alexei/FlyWithMeOC2/Web/admin/articles-list-unvalidated-comment-' . $id_article . '.html';
    
    $this->app->httpResponse()->redirect($redirection);
    
  }
  
  
  
  
  public function executeValidateUnvalidatedGroupComment(HTTPRequest $request)
  {
    
    $CommentsIdsToBeValidated = $request->getData('CommentsIdsToBeValidated');
    $CommentsIdsToBeValidated = substr($CommentsIdsToBeValidated, 1, $CommentsIdsToBeValidated.length - 1);
	
	$CommentsIdsToBeValidatedArray = explode(",",$CommentsIdsToBeValidated);
    
    
    
    $id_article = $request->getData('id_article');
    
    foreach ($CommentsIdsToBeValidatedArray as $CommentsId) {
    	$this->managers->getManagerOf('Comments')->validateCommentWithId($CommentsId);
	}
    
    $this->app->user()->setFlash('Les commentaires ont bien été validés !');
    $redirection = 'http://localhost/~alexei/FlyWithMeOC2/Web/admin/articles-list-unvalidated-comment-' . $id_article . '.html';
    
    $this->app->httpResponse()->redirect($redirection);
    
  }
  
  
  
  



}



























