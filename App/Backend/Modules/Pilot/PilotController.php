<?php
namespace App\Backend\Modules\Pilot;
 
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Pilot;

use \FormBuilder\CommentFormBuilder;
use \FormBuilder\ArticlesFormBuilder;
use \OCFram\FormHandler;
 
class PilotController extends BackController
{
  public function executeIndex(HTTPRequest $request)
  {
    //echo 'PilotController->executeIndex<br>';
    $this->page->addVar('title', 'Gestion des Pilotes');
 
    $pilotmanager = $this->managers->getManagerOf('Pilot');
    
    $this->page->addVar('listePilotes', $pilotmanager->getAllPilots());
    
    
    $CountCommentsFromPilotName = $pilotmanager->getCountCommentsFromPilots($pilotname);
    $this->page->addVar('CountCommentsFromPilotName', $CountCommentsFromPilotName);
    
    
  }
  
  
  
  
  public function executeListCommentPilot(HTTPRequest $request)
  {
    //echo 'PilotController->executeListCommentPilot<br>';
    $pilotname = $request->getData('pilotname');
    
    $this->page->addVar('title', 'commentaires de ' . $pilotname);
    $this->page->addVar('pilotname', $pilotname);
    
    
    $pilotmanager = $this->managers->getManagerOf('Pilot');
    
    $AllCommentsFromPilotName = $pilotmanager->getAllCommentsFromPilots($pilotname);
    $this->page->addVar('AllCommentsFromPilotName', $AllCommentsFromPilotName);
    
   }
  
  
  
  
  public function executeDeletePilot(HTTPRequest $request)
  {
    //echo 'PilotController->executeDeletePilot<br>';
    $this->page->addVar('title', 'suppression d\'un pilote');
    
    $piloteId = $request->getData('id');
    $pilotmanager = $this->managers->getManagerOf('Pilot');
    
    $pilotmanager->deletePilot($piloteId);
    
 
    $this->app->user()->setFlash('Le pilote a bien été supprimé !');
 
    $this->app->httpResponse()->redirect('http://localhost/~alexei/FlyWithMeOC2/Web/admin/pilotes/');
  }
 
 
 

  public function executeUpdate(HTTPRequest $request)
  {
    $this->processForm($request);
    
    $title_article = $this->managers->getManagerOf('articles')->getUnique($request->getData('id'))->titre();
    //echo 'title_article : ' . $title_article;
    $this->page->addVar('title_article', $title_article );
    
    $this->page->addVar('title', 'Modification de l\'article');
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
  
  
  
  
  
  

}



























