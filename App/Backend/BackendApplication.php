<?php
namespace App\Backend;
 
use \OCFram\Application;
 
class BackendApplication extends Application
{
  public function __construct()
  {
    parent::__construct();
 
    $this->name = 'Backend';
  }
 
  public function run()
  {
    //echo 'BackendApplication->run()<br>';
    // $_SESSION['auth'] = false;
//     	$_SESSION['name'] = "";
// 		$_SESSION['connected'] = false;
    
    if ($this->user->isAuthenticated())
    {
      	//echo 'user->isAuthenticated<br>';
      	//$this->app->user()->UnAuthenticate();
      	
      	$controller = $this->getController();
      	
    }
    else
    {
      //echo 'connexion<br>';
      // $_SESSION['auth'] = false;
//     	$_SESSION['name'] = "";
// 		$_SESSION['connected'] = false;
      $controller = new Modules\Connexion\ConnexionController($this, 'Connexion', 'index');
      
    }
    
    
 
    $controller->execute();
 
    $this->httpResponse->setPage($controller->page());
    $this->httpResponse->send();
    $this->app->user()->UnAuthenticate();
    // $_SESSION['auth'] = false;
//     	$_SESSION['name'] = "";
// 		$_SESSION['connected'] = false;
    
    
    
  }
}