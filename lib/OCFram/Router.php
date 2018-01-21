<?php namespace OCFram;
 
class Router
{
  protected $routes = [];
 
  const NO_ROUTE = 1;
 
  public function addRoute(Route $route)
  {
    if (!in_array($route, $this->routes))
    {
      $this->routes[] = $route;
    }
  }

  public function getRoute($url)
  {
    //echo 'dans routeur->getRoute($url) - url : ' . $url . '<br>';
    foreach ($this->routes as $route)
    {
      // Si la route correspond à l'URL
      
      //echo '<br> route du xml : ' . $route->url() . '<br>';
      
      if (($varsValues = $route->match($url)) !== false)
      {
        //echo 'Varvalues : ' . $varsValues[0] . '<br>';
        
        // Si elle a des variables
        if ($route->hasVars())
        {
          //echo 'la route a des variables<br>';
          $varsNames = $route->varsNames();
          $listVars = [];
 
          // On crée un nouveau tableau clé/valeur
          // (clé = nom de la variable, valeur = sa valeur)
          foreach ($varsValues as $key => $match)
          {
            // La première valeur contient entièrement la chaine capturée (voir la doc sur preg_match)
            if ($key !== 0)
            {
              $listVars[$varsNames[$key - 1]] = $match;
            }
          }
 
          // On assigne ce tableau de variables � la route
          $route->setVars($listVars);
        }
 		
 		//echo 'routeur->getRoute($url) : ' . $route->url() . '<br>';
        return $route;
      }
    }
 
 	//echo 'avant le runtime exception';
    throw new \RuntimeException('Aucune route ne correspond à l\'URL', self::NO_ROUTE);
    
    //throw new \RuntimeException('Aucune route ne correspond à l\'URL');
    
    
    
  }
}


