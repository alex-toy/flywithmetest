<?php

namespace App\Frontend\Modules\Pilot;


use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Pilot;
use \Entity\Articles;
use \FormBuilder\PilotConnectFormBuilder;
use \FormBuilder\PilotFormBuilder;
use \OCFram\FormHandler;
use \Entity\User;



class PilotController extends BackController
{
  
  public function executeConnect(HTTPRequest $request)
  {
    $this->page->addVar('title', 'connexion');
    
    
    $pilotManager = $this->managers->getManagerOf('Pilot');
    
    
    if ($request->method() == 'POST')
    {
      $pilot = new Pilot([
        'pilotname' => $request->postData('pilotname'),
        'email' => "a@a.fr",
        'pwrd' => $request->postData('pwrd')
      ]);
    }
    else
    {
    	$pilot = new Pilot;
    }
    
    
    
    $formBuilder = new PilotConnectFormBuilder($pilot);
    $formBuilder->build();
    $form = $formBuilder->form();
   
	
	$formHandler = new FormHandler($form, $pilotManager, $request);
	if($formHandler->check()){
		if($pilotManager->IsPilot($pilot)){
			$_SESSION['name'] = $pilot->pilotname();
			$_SESSION['connected'] = true;
			$this->app->httpResponse()->redirect('http://localhost/~alexei/FlyWithMeOC2/Web/articles');
		}
		else if( !empty($pilot->pilotname()) && !empty($pilot->pwrd()) ){
			$_SESSION['name'] = "";
			$_SESSION['connected'] = false;
			$this->app->user()->setFlash('Désolé, cet identifiant et mot de passe sont inconnus!!');
	
		}
    }
 
    $this->page->addVar('form', $form->createView());
    
  }
  
  
  public function executeCreateAccount(HTTPRequest $request)
  {
    $this->page->addVar('title', 'création d\'un compte');
    
    
    $pilotManager = $this->managers->getManagerOf('Pilot');
    
    
    if ($request->method() == 'POST')
    {
      
      $pilot = new Pilot([
        'pilotname' => $request->postData('pilotname'),
        'email' => $request->postData('email'),
        'pwrd' => $request->postData('pwrd')
      ]);
      
      if( empty($pilot->pilotname()) && empty($pilot->email()) && empty($pilot->pwrd()) ){
      		$this->app->user()->setFlash('un peu d\'inspiration !!');
     }
     	
    }
    else
    {
      	
    	$pilot = new Pilot;
    }
    
    $formBuilder = new PilotFormBuilder($pilot);
    $formBuilder->build();
    $form = $formBuilder->form();
	
	
	if( $pilotManager->HasUniqueName($pilot->pilotname()) && $pilotManager->HasUniqueMail($pilot->email())){
		$formHandler = new FormHandler($form, $pilotManager, $request);
		if ($formHandler->process() )
		{
			
			$this->app->user()->setFlash($pilot->pilotname() . ', Bienvenue chez FlyWithMe !!');
			$this->app->httpResponse()->redirect('http://localhost/~alexei/FlyWithMeOC2/Web/articles');
		}
	}
 	else if( !$pilotManager->HasUniqueName($pilot->pilotname()) && !empty($pilot->pilotname()) ){
		$this->app->user()->setFlash('Ce nom existe déjà. Essayez avec autre chose !');
	}
	else if( !$pilotManager->HasUniqueMail($pilot->email()) && !empty($pilot->email()) ){
		$this->app->user()->setFlash('Ce mail existe déjà. Essayez avec autre chose !');
	}
    
 
    $this->page->addVar('form', $form->createView());

    
  }
  
  
  public function executeDisconnect()
  {
    $this->page->addVar('title', 'connection');
    
    $_SESSION['name'] = "";
	$_SESSION['connected'] = false;
    
    $this->app->httpResponse()->redirect('http://localhost/~alexei/FlyWithMeOC2/Web/articles');
   
    
    

    
  }
  


}















