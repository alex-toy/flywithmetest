<?php
namespace OCFram;
 
class PDOFactory
{
  public static function getMysqlConnexion()
  {
    
    $db = new \PDO('mysql:host=localhost;dbname=news;charset=utf8', 'root', 'root');

    
    
    //$db = new \PDO('mysql:host=db725682133.db.1and1.com;dbname=db725682133;charset=utf8', 'dbo725682133', 'Colmoschin.80');
    $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
 
    return $db;
  }
}




