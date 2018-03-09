<?php
namespace FormBuilder;
 
use \OCFram\FormBuilder;
use \OCFram\StringField;
use \OCFram\PwdField;
use \OCFram\TextField;
use \OCFram\MaxLengthValidator;
use \OCFram\NotNullValidator;
use \OCFram\MinLengthValidator;



 
class PilotConnectFormBuilder extends FormBuilder
{
  
  public function build()
  {
    
    $pilotname = new StringField([
        'label' => 'nom',
        'name' => 'pilotname',
        'maxLength' => 20,
        'validators' => [ new NotNullValidator('Merci de spécifier un nom') ]
       ]);
       
   
    $pwrd = new PwdField([
        'label' => 'mot de passe',
        'name' => 'pwrd',
        'maxLength' => 100,
        'validators' => [ new NotNullValidator('Merci de spécifier un mot de passe') ]
       ]);
       
    $this->form->add($pilotname)->add($pwrd);
       
    
  }
  
}



























