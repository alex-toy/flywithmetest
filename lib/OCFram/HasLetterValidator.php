<?php
namespace OCFram;
 
class HasLetterValidator extends Validator
{
  public function isValid($value)
  {
    preg_match('/[a-z]+/', $value, $matches);
    return !empty($matches);
  }
}