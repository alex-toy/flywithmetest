<?php
namespace OCFram;
 
class Form
{
  protected $entity;
  protected $fields = [];
 
  public function __construct(Entity $entity)
  {
    $this->setEntity($entity);
  }
 
  public function add(Field $field)
  {
    
    $attr = $field->name(); // On récupère le nom du champ.
   
    
    $field->setValue($this->entity->$attr()); // On assigne la valeur correspondante au champ.
 
    $this->fields[] = $field; // On ajoute le champ passé en argument à la liste des champs.
    
    return $this;
  }
 
  public function createView()
  {
    $view = '';
 
    foreach ($this->fields as $field)
    {
      $view .= $field->buildWidget().'<br />';
    }
 
    return $view;
  }
 
  public function isValid()
  {
    $valid = true;
 
    foreach ($this->fields as $field)
    {
      if (!$field->isValid())
      {
        $valid = false;
      }
    }
    return $valid;
  }
 
  public function entity()
  {
    echo get_class($this->entity);
    return $this->entity;
  }
 
  public function setEntity(Entity $entity)
  {
    $this->entity = $entity;
  }
}













