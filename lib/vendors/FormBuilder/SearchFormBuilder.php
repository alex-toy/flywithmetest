<?php
namespace FormBuilder;
 
use \OCFram\FormBuilder;
use \OCFram\StringField;
use \OCFram\TextField;
use \OCFram\MenuField;
use \OCFram\MaxLengthValidator;
use \OCFram\NotNullValidator;

class SearchFormBuilder extends FormBuilder
{
  
  public function build()
  {
    $this->form
    
       ->add(new MenuField([
        'label' => 'départ',
        'name' => 'contenu',
        'rows' => 7,
        'cols' => 150,
        'validators' => [
          new NotNullValidator('Merci de spécifier votre commentaire'),
        ],
       ]))
       
       ->add(new MenuField([
        'label' => 'arrivée',
        'name' => 'contenu',
        'rows' => 7,
        'cols' => 150,
        'validators' => [
          new NotNullValidator('Merci de spécifier votre commentaire'),
        ],
       ]));
  
  }
}








































