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
    if ($this->user->isAuthenticated())
    {
      //echo 'user->isAuthenticated<br>';
      // $this->user->UnAuthenticate();
      $controller = $this->getController();
    }
    else
    {
      //echo 'connexion<br>';
      $controller = new Modules\Connexion\ConnexionController($this, 'Connexion', 'index');
    }
    
    
 
    $controller->execute();
 
    $this->httpResponse->setPage($controller->page());
    $this->httpResponse->send();
    $this->app->user()->UnAuthenticate();
    
    
  }
}