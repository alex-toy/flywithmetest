<?php
namespace FormBuilder;
 
use \OCFram\FormBuilder;
use \OCFram\StringField;
use \OCFram\TextField;
use \OCFram\MaxLengthValidator;
use \OCFram\NotNullValidator;
 
class ArticlesFormBuilder extends FormBuilder
{
  public function build()
  {
    $this->form
       
       ->add(new StringField([
        'label' => 'Départ',
        'name' => 'depart',
        'maxLength' => 100,
        'validators' => [
          new MaxLengthValidator('Le titre spécifié est trop long (100 caractères maximum)', 100),
          new NotNullValidator('Merci de spécifier le titre de la news'),
        ],
       ]))
       
       ->add(new StringField([
        'label' => 'Arrivée',
        'name' => 'arrivee',
        'maxLength' => 100,
        'validators' => [
          new MaxLengthValidator('Le titre spécifié est trop long (100 caractères maximum)', 100),
          new NotNullValidator('Merci de spécifier le titre de la news'),
        ],
       ]))
       
       
       ->add(new TextField([
        'label' => 'Contenu',
        'name' => 'contenu',
        'rows' => 20,
        'cols' => 160,
        'validators' => [
          new NotNullValidator('Merci de spécifier le contenu de la news'),
        ],
       ]));
  
  }
}