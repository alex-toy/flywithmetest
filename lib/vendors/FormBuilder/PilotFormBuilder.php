<?php
namespace FormBuilder;
 
use \OCFram\FormBuilder;
use \OCFram\StringField;
use \OCFram\TextField;
use \OCFram\MaxLengthValidator;
use \OCFram\NotNullValidator;
use \OCFram\MailFormatValidator;
use \OCFram\MinLengthValidator;


 
class PilotFormBuilder extends FormBuilder
{
  
  public function build()
  {
    //echo 'PilotFormBuilder->build<br>';
    
    $pilotname = new StringField([
        'label' => 'nom',
        'name' => 'pilotname',
        'maxLength' => 20,
        'validators' => [
          	new MaxLengthValidator('Le nom spécifié est trop long (100 caractères maximum)', 20),
          	new NotNullValidator('Merci de spécifier un nom')
         ]
       ]);
       
	$email = new StringField([
        'label' => 'email',
        'name' => 'email',
        'maxLength' => 100,
        'validators' => [
          	new MailFormatValidator('merci de spécifier une adresse mail valide', 100),
          	new NotNullValidator('Merci de spécifier une adresse mail')
         ]
       ]); 
       
    $pwrd = new StringField([
        'label' => 'mot de passe',
        'name' => 'pwrd',
        'maxLength' => 100,
        'validators' => [
          	new MinLengthValidator('Le mot de passe est trop court (10 caractères minimum)', 10)
         ]
       ]);
       
    $this->form->add($pilotname)->add($email)->add($pwrd);
       
    
  }
  
}



























