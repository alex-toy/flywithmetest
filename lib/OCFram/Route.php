<?php namespace OCFram;

 
 
class Route
{
  protected $action;
  protected $module;
  protected $url;
  protected $varsNames;
  protected $vars = [];
 
  public function __construct($url, $module, $action, array $varsNames, $comp)
  {
    $this->setUrl($url);
    $this->setModule($module);
    $this->setAction($action);
    $this->setVarsNames($varsNames);
  }
 
  public function hasVars()
  {
    return !empty($this->varsNames);
  }
 
  public function match($url)
  {  
    $regex = $this->url;
    $regex = str_replace( '/' , '\/' , $regex);
    //echo 'test replace : ' . $regex . '<br>';
    $regex = '/^' . $regex . '$/';
    
    //echo 'url : ' . $url . '<br>';

    if (preg_match($regex, $url, $matches))
    {
      //echo 'matches : ' . $matches[0] . '<br>';
      return $matches;
    }
    else
    {
      //echo 'dans le false <br>';
      return false;
    }
  }
 
  public function setAction($action)
  {
    if (is_string($action))
    {
      $this->action = $action;
    }
  }
 
  public function setModule($module)
  {
    if (is_string($module))
    {
      $this->module = $module;
    }
  }
 
  public function setUrl($url)
  {
    if (is_string($url))
    {
      $this->url = $url;
    }
  }
 
  public function setVarsNames(array $varsNames)
  {
    $this->varsNames = $varsNames;
  }
 
  public function setVars(array $vars)
  {
    $this->vars = $vars;
  }
 
  public function action()
  {
    return $this->action;
  }
 
  public function module()
  {
    return $this->module;
  }
 
  public function vars()
  {
    return $this->vars;
  }
 
  public function varsNames()
  {
    return $this->varsNames;
  }
  
  public function url()
  {
    return $this->url;
  }
  
}




















