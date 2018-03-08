<?php
namespace OCFram;
 
class PwdField extends Field
{
  protected $maxLength;
 
  public function buildWidget()
  {
    $widget = '';
 
    if (!empty($this->errorMessage))
    {
      $widget .= $this->errorMessage.'<br />';
    }
 	
    $widget .= '<label>'.$this->label.' : </label><br><input type="password" name="'.$this->name.'"' ;
 
    if (!empty($this->value))
    {
      $widget .= ' value="'.htmlspecialchars($this->value).'"';
    }
 
    if (!empty($this->maxLength))
    {
      $widget .= ' maxlength="'.$this->maxLength.'"';
    }
    
    $widget .= ' />';
    
    return $widget;
  }
 
  public function setMaxLength($maxLength)
  {
    $maxLength = (int) $maxLength;
    
    if ($maxLength <= 0)
    {
      throw new \RuntimeException('La longueur maximale doit être un nombre supérieur à 0');
    }
    $this->maxLength = $maxLength;

  }

}








