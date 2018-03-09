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
use \OCFram\HasLetterValidator;


 
class PilotFormBuilder extends FormBuilder
{
  
  public function build()
  {
    
    $pilotname = new StringField([
        'label' => 'nom',
        'name' => 'pilotname',
        'maxLength' => 20,
        'validators' => [
          	new MaxLengthValidator('Le nom spécifié est trop long (15 caractères maximum)', 15),
          	new NotNullValidator('Merci de spécifier un nom')
         ]
       ]);
       
	$email = new StringField([
        'label' => 'email',
        'name' => 'email',
        'maxLength' => 100,
        'validators' => [
          	new MailFormatValidator('Merci de spécifier une adresse mail valide', 100),
          	new NotNullValidator('Merci de spécifier une adresse mail')
         ]
       ]); 
       
    $pwrd = new PwdField([
        'label' => 'mot de passe',
        'name' => 'pwrd',
        'maxLength' => 100,
        'validators' => [
          	new MinLengthValidator('Le mot de passe est trop court (10 caractères minimum)', 10),
          	new HasNumberValidator('Le mot de passe doit contenir au moins un chiffre.'),
          	new HasLetterValidator('Le mot de passe doit contenir au moins une lettre.')
         ]
       ]);
       
    $this->form->add($pilotname)->add($email)->add($pwrd);
       
    
  }
  
}



























