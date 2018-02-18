<?php
namespace App\Frontend;
 

use \OCFram\Application;
 
class FrontendApplication extends Application
{
  public function __construct()
  {
    parent::__construct();
 
    $this->name = 'Frontend';
  }
 
  public function run()
  { 
    //echo 'FrontendApplication->run<br>';
    
    $this->user->UnAuthenticate();
    
    $controller = $this->getController();
    
	//echo '$controller->execute()<br>';
    $controller->execute();
    
   
    $this->httpResponse->setPage($controller->page());
    $this->httpResponse->send();
  }
}




