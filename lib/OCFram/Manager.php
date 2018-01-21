<?php
namespace OCFram;
 
abstract class Manager
{
  protected $dao;
 
  public function __construct($dao)
  {
    //echo 'dans le manager<br>';
    $this->dao = $dao;
  }
}