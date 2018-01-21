<?php
namespace Entity;
 
use \OCFram\Entity;
 
class Comment extends Entity
{
  protected $id_article,
            $auteur,
            $contenu,
            $date,
            $validated,
            $id_comment;
 
  const AUTEUR_INVALIDE = 1;
  const CONTENU_INVALIDE = 2;
 
  public function isValid()
  {
    return !(empty($this->auteur) || empty($this->contenu));
  }
 
  public function setId_article($id_article)
  {
    $this->id_article = (int) $id_article;
  }
 
  public function setAuteur($auteur)
  {
    if (!is_string($auteur) || empty($auteur))
    {
      $this->erreurs[] = self::AUTEUR_INVALIDE;
    }
 
    $this->auteur = $auteur;
  }
 
  public function setContenu($contenu)
  {
    if (!is_string($contenu) || empty($contenu))
    {
      $this->erreurs[] = self::CONTENU_INVALIDE;
    }
 
    $this->contenu = $contenu;
  }
 
  public function setDate(\DateTime $date)
  {
    $this->date = $date;
  }
  
  public function SetValidated($validated)
  {
    $this->validated = $validated;
  }
 
  public function id_article()
  {
    return $this->id_article;
  }
 
  public function auteur()
  {
    return $this->auteur;
  }
 
  public function contenu()
  {
    return $this->contenu;
  }
 
  public function date()
  {
    return $this->date;
  }
  
  public function id()
  {
    return $this->id;
  }
}