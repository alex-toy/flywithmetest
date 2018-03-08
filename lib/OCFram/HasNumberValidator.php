<?php
namespace OCFram;
 
class HasNumberValidator extends Validator
{
  public function isValid($value)
  {
    preg_match('/\d+/', $value, $matches);
    return !empty($matches);
  }
}