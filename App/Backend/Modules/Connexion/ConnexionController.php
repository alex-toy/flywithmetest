<?php
namespace App\Backend\Modules\Connexion;
 
use \OCFram\BackController;
use \OCFram\HTTPRequest;
 
class ConnexionController extends BackController
{
  public function executeIndex(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Connexion');
 
    if ($request->postExists('login'))
    {
      $login = $request->postData('login');
      $password = $request->postData('password');
      
      //echo 'login : ' . $this->app->config()->get('login') . '<br>';
      //echo 'pass : ' . $this->app->config()->get('passw') . '<br>';
 
      if ($login == $this->app->config()->get('login') && $password == $this->app->config()->get('passw'))
      {
        //echo 'avant le redirect<br>';
        $this->app->user()->setAuthenticated(true);
        $password = '';
        $login = '';
        $this->app->httpResponse()->redirect('.');
      }
      else
      {
        $this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect.');
      }
    }
  }
}









