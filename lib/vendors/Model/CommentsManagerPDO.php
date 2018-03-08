<?php
namespace Model;
 
use \Entity\Comment;
 
class CommentsManagerPDO extends CommentsManager
{
  protected function add(Comment $comment)
  {
    $q = $this->dao->prepare('INSERT INTO comments SET id_article = :id, auteur = :auteur, contenu = :contenu, date = NOW()');
 
    $q->bindValue(':id', $comment->id_article(), \PDO::PARAM_INT);
    $q->bindValue(':auteur', $comment->auteur());
    $q->bindValue(':contenu', $comment->contenu());
 
    $q->execute();
 
    $comment->setId($this->dao->lastInsertId());
  }
 
  public function delete($id)
  {
    $this->dao->exec('DELETE FROM comments WHERE id = '.(int) $id);
  }
 
  public function deleteFromNews($id_article)
  {
    $this->dao->exec('DELETE FROM comments WHERE id_article = '.(int) $id_article);
  }
 
  public function getListOf($id_article)
  {
    if (!ctype_digit($id_article))
    {
      throw new \InvalidArgumentException('L\'identifiant de la news passé doit être un nombre entier valide');
    }
 
    $q = $this->dao->prepare('SELECT id, id_article, auteur, contenu, date FROM comments WHERE id_article = :id_article');
    $q->bindValue(':id_article', $id_article, \PDO::PARAM_INT);
    $q->execute();
 
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
 
    $comments = $q->fetchAll();
 
    foreach ($comments as $comment)
    {
      $comment->setDate(new \DateTime($comment->date()));
    }
 
    return $comments;
  }
  
  public function getValidatedComments($id_article)
  {
    if (!ctype_digit($id_article))
    {
      throw new \InvalidArgumentException('L\'identifiant de la news passé doit être un nombre entier valide');
    }
 
    $q = $this->dao->prepare('SELECT id, id_article, auteur, contenu, date FROM comments WHERE id_article = :id_article AND validated = true');
    $q->bindValue(':id_article', $id_article, \PDO::PARAM_INT);
    $q->execute();
 
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
 
    $comments = $q->fetchAll();
 
    foreach ($comments as $comment)
    {
      $comment->setDate(new \DateTime($comment->date()));
    }
 
    return $comments;
  }
  
  public function getUnvalidatedComments($id_article)
  {
    if (!ctype_digit($id_article))
    {
      throw new \InvalidArgumentException('L\'identifiant de la news passé doit être un nombre entier valide');
    }
 
    $q = $this->dao->prepare('SELECT id, id_article, auteur, contenu, date FROM comments WHERE id_article = :id_article AND validated = false');
    $q->bindValue(':id_article', $id_article, \PDO::PARAM_INT);
    $q->execute();
 
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
 
    $comments = $q->fetchAll();
 
    foreach ($comments as $comment)
    {
      $comment->setDate(new \DateTime($comment->date()));
    }
 
    return $comments;
  }
 
  protected function modify(Comment $comment)
  {
    $q = $this->dao->prepare('UPDATE comments SET auteur = :auteur, contenu = :contenu WHERE id = :id');
 
    $q->bindValue(':auteur', $comment->auteur());
    $q->bindValue(':contenu', $comment->contenu());
    $q->bindValue(':id', $comment->id(), \PDO::PARAM_INT);
 
    $q->execute();
  }
 
  public function get($id)
  {
    $q = $this->dao->prepare('SELECT * FROM comments WHERE id = :id');
    $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $q->execute();
 
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
 
    return $q->fetch();
  }
  
  public function validateCommentWithId($id_comment)
  {
    if (!ctype_digit($id_comment))
    {
      throw new \InvalidArgumentException('L\'identifiant de la news passé doit être un nombre entier valide');
    }
 
    $q = $this->dao->prepare('UPDATE comments SET validated = true WHERE id = :id_comment;');
    $q->bindValue(':id_comment', $id_comment, \PDO::PARAM_INT);
    $q->execute();
  }
}

















