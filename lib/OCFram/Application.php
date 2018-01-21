<?php
namespace OCFram;


abstract class Application
{
  protected $httpRequest;
  protected $httpResponse;
  protected $name;
  protected $user;
  protected $config;
 
  public function __construct()
  {
    $this->httpRequest = new HTTPRequest($this);
    $this->httpResponse = new HTTPResponse($this);
    $this->user = new User($this);
    $this->config = new Config($this);
 
    $this->name = '';
  }
 
  public function getController()
  {
    
    //echo 'nom de l\'application : ' . $this->name . '<br>';
    
    $router = new Router;
 
    $xml = new \DOMDocument;
    $xml->load(__DIR__.'/../../App/'.$this->name.'/Config/routes.xml');
 
    $routes = $xml->getElementsByTagName('route');
 
    // On parcourt les routes du fichier XML.
    foreach ($routes as $route)
    {
      $vars = [];
 
      // On regarde si des variables sont présentes dans l'URL.
      if ($route->hasAttribute('vars'))
      {
        $vars = explode(',', $route->getAttribute('vars'));
      }
 
      // On ajoute la route au routeur.
      $router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $vars, $route->getAttribute('comp')));
      
      //echo $route->getAttribute('url') . '<br>';
    }
 
    try
    {
      // On récupère la route correspondante à l'URL.
      //echo 'requestURI : ' . $this->httpRequest->requestURI() . '<br>';
      
      $matchedRoute = $router->getRoute($this->httpRequest->requestURI());
      
      //echo 'matchedRoute->url : '. $matchedRoute->url() .'<br>';
    }
    catch (\RuntimeException $e)
    {
      if ($e->getCode() == Router::NO_ROUTE)
      {
        // Si aucune route ne correspond, c'est que la page demandée n'existe pas.
        $this->httpResponse->redirect404();
      }
    }
 
    // On ajoute les variables de l'URL au tableau $_GET.
    $_GET = array_merge($_GET, $matchedRoute->vars());
    //echo '$_GET : ' . $_GET[0] . '<br>';
 
    // On instancie le contrôleur.
    $controllerClass = 'App\\'.$this->name.'\\Modules\\'.$matchedRoute->module().'\\'.$matchedRoute->module().'Controller';
    
    //echo 'controllerClass : '. $controllerClass . '<br>';
    //echo 'module : '. $matchedRoute->module() . '<br>';
    //echo 'action : '. $matchedRoute->action() . '<br>';
    
    return new $controllerClass($this, $matchedRoute->module(), $matchedRoute->action() );
    
  }
 
  abstract public function run();
 
  public function httpRequest()
  {
    return $this->httpRequest;
  }
 
  public function httpResponse()
  {
    return $this->httpResponse;
  }
 
  public function name()
  {
    return $this->name;
  }
 
  public function config()
  {
    return $this->config;
  }
 
  public function user()
  {
    return $this->user;
  }
}










