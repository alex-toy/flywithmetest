<?php
namespace OCFram;
 
class MailFormatValidator extends Validator
{
  public function isValid($value)
  {
	if ( preg_match ( " /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ " , $value ) )
	{
		return true;
	}
    return false;
    
  }
}