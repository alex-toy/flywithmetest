<?php
namespace OCFram;
 
class MenuField extends Field
{
	protected $maxLength;
  
  
  public function buildWidget()
  {
    $errorMessage = !empty($this->errorMessage) ?: "";
    $label = !empty($this->label) ? $this->label : "";
    $name = !empty($this->name) ? $this->name : "";
    $value = !empty($this->value) ? htmlspecialchars($this->value) : "";
    
    
    $widget = '
    <p>' . $label . ' :</p>' . 
    '<select name="cars">
  		<option value="volvo">Volvo</option>
 	 	<option value="saab">Saab</option>
  		<option value="fiat">Fiat</option>
  		<option value="audi">Audi</option>
	</select>';
 
    return $widget;
  }
 
  public function setMaxLength($maxLength)
  {
    $maxLength = (int) $maxLength;
 
    if ($maxLength > 0)
    {
      $this->maxLength = $maxLength;
    }
    else
    {
      throw new \RuntimeException('La longueur maximale doit être un nombre supérieur à 0');
    }
  }
}
