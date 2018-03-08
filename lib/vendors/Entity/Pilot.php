<?php
namespace Entity;
 
use \OCFram\Entity;
 
class Pilot extends Entity
{
  protected $pilotname,
            $email,
            $registered,
            $pwrd;
            
 
  const NAME_INVALIDE = 1;
  const EMAIL_INVALIDE = 2;
  

  public function isValid()
  {
    return !(empty($this->pilotname) || empty($this->email) );
  }
  
  public function setPwrd($pwrd)
  {
    $this->pwrd = $pwrd;
  }
 
  public function setPilotname($pilotname)
  {
    if (!is_string($pilotname) || empty($pilotname))
    {
      $this->erreurs[] = self::NAME_INVALIDE;
    }
 
    $this->pilotname = $pilotname;
  }
  
  public function setEmail($email)
  {
    if (!is_string($email) || empty($email))
    {
      $this->erreurs[] = self::EMAIL_INVALIDE;
    }
 
    $this->email = $email;
    //echo 'email : ' . $this->email . '<br>';
  }
  
  public function Register()
  {
    $this->registered = true;
  }
  
  public function UnRegister()
  {
    $this->registered = false;
  }
  
  
 
  
 
  public function pilotname()
  {
    return $this->pilotname;
  }
 
  public function email()
  {
    return $this->email;
  }
 
  public function isRegistered()
  {
    return $this->registered;
  }
  
  public function pwrd()
  {
    return $this->pwrd;
  }
 
}














