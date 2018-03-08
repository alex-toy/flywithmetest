<?php
namespace FormBuilder;
 
use \OCFram\FormBuilder;
use \OCFram\StringField;
use \OCFram\PwdField;
use \OCFram\TextField;
use \OCFram\MaxLengthValidator;
use \OCFram\NotNullValidator;
use \OCFram\MailFormatValidator;
use \OCFram\MinLengthValidator;
use \OCFram\HasNumberValidator;


 
class PilotConnectFormBuilder extends FormBuilder
{
  
  public function build()
  {
    
    $pilotname = new StringField([
        'label' => 'nom',
        'name' => 'pilotname',
        'maxLength' => 20,
        'validators' => [
          	new MaxLengthValidator('Le nom spécifié est trop long (100 caractères maximum)', 20),
          	new NotNullValidator('Merci de spécifier un nom')
         ]
       ]);
       
   
    $pwrd = new PwdField([
        'label' => 'mot de passe',
        'name' => 'pwrd',
        'maxLength' => 100,
        'validators' => [
          	new MinLengthValidator('Le mot de passe est trop court (10 caractères minimum)', 10),
          	new HasNumberValidator('Le mot de passe doit contenir au moins un chiffre.', 10),
         ]
       ]);
       
    $this->form->add($pilotname)->add($pwrd);
       
    
  }
  
}



























