<?php
namespace OCFram;
 
class MinLengthValidator extends Validator
{
  protected $minLength;
 
  public function __construct($errorMessage, $minLength)
  {
    parent::__construct($errorMessage);
 
    $this->setMinLength($minLength);
  }
 
  public function isValid($value)
  {
    return strlen($value) >= $this->minLength;
  }
 
  public function setMinLength($minLength)
  {
    $minLength = (int) $minLength;
 
    
    if ($minLength <= 0)
    {
      throw new \RuntimeException('La longueur minimale doit être un nombre supérieur à 0');
    }
    $this->minLength = $minLength;
    
  }
}