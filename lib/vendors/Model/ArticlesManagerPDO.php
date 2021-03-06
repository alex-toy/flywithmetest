<?php
namespace Model;
 
use \Entity\Articles;
 
class ArticlesManagerPDO extends ArticlesManager
{
  protected function add(Articles $art)
  {
    $requete = $this->dao->prepare('INSERT INTO article SET depart = :depart, arrivee = :arrivee,  titre = :titre, contenu = :contenu, dateAjout = NOW(), dateModif = NOW()');
 
    $requete->bindValue(':titre', $art->titre());
    $requete->bindValue(':depart', $art->depart());
    $requete->bindValue(':arrivee', $art->arrivee());
    $requete->bindValue(':contenu', $art->contenu());
 
    $requete->execute();
  }
 
 
 
  public function count()
  {
    return $this->dao->query('SELECT COUNT(*) FROM article')->fetchColumn();
  }
 
 
 
  public function delete($id)
  {
    $this->dao->exec('DELETE FROM article WHERE id = '.(int) $id);
  }
 
 
 
  public function getList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT id, titre, depart, arrivee, contenu, dateAjout, dateModif FROM article ORDER BY id DESC';
 
    if ($debut != -1 || $limite != -1)
    {
      $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
    }
 
    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Articles');
 
    $listeArticles = $requete->fetchAll();
    
    date_default_timezone_set('Europe/Paris');
 
    foreach ($listeArticles as $news)
    {
      $news->setDateAjout(new \DateTime($news->dateAjout()));
      $news->setDateModif(new \DateTime($news->dateModif()));
    }
 
    $requete->closeCursor();
 
    return $listeArticles;
  }
  
  
  
  public function getAllArticles()
  {
    $sql = 'SELECT id, titre, depart, arrivee, contenu, dateAjout, dateModif FROM article ORDER BY id DESC';

 
    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Articles');
 
    $listeNews = $requete->fetchAll();
    
    date_default_timezone_set('Europe/Paris');
 
    foreach ($listeNews as $news)
    {
      $news->setDateAjout(new \DateTime($news->dateAjout()));
      $news->setDateModif(new \DateTime($news->dateModif()));
    }
 
    $requete->closeCursor();
 
    return $listeNews;
  }
  
  
  
  public function getAllTitle()
  {
    $sql = 'SELECT id, titre FROM article ORDER BY id DESC';

    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Articles');
 
    $listeNews = $requete->fetchAll();
    
    $requete->closeCursor();
 
    return $listeNews;
    
  }
  
  
  
  public function getTitleById($id_article)
  {
    $sql = 'SELECT titre FROM article WHERE id = :id_article;';

    $requete = $this->dao->prepare($sql);
    $requete->bindValue(':id_article', (int) $id_article, \PDO::PARAM_INT);
    $requete->execute();
 
    $titre_article = $requete->fetchAll();
    
    $requete->closeCursor();
 
    return $titre_article[0];
    
  }
  
  
  
  public function getListCommentById($id_article)
  {
    $sql = 'SELECT id, auteur, contenu FROM comments WHERE id_article = :id_article;';
    

    $requete = $this->dao->prepare($sql);
    $requete->bindValue(':id_article', (int) $id_article, \PDO::PARAM_INT);
    $requete->execute();
 
    $list_comment = $requete->fetchAll();
       
    
    $requete->closeCursor();
 
    return $list_comment;
    
  }
  
  
  
  public function getListValidatedCommentById($id_article)
  {
    
    $sql = 'SELECT id, auteur, contenu FROM comments WHERE id_article = :id_article AND validated = true;';

    $requete = $this->dao->prepare($sql);
    $requete->bindValue(':id_article', (int) $id_article, \PDO::PARAM_INT);
    $requete->execute();
 
    $list_comment = $requete->fetchAll();
       
    
    $requete->closeCursor();
 
    return $list_comment;
    
  }
  
  
  
  public function getUnvalidatedComments($id_article)
  {
    //echo 'getListCommentById : ' . $id_article . '<br>';
    
    $sql = 'SELECT * FROM comments WHERE id_article = :id_article AND validated = false;';

    $requete = $this->dao->prepare($sql);
    $requete->bindValue(':id_article', (int) $id_article, \PDO::PARAM_INT);
    $requete->execute();
 
    $list_comment = $requete->fetchAll();
       
    
    $requete->closeCursor();
 
    return $list_comment;
    
  }
  
  
  public function getNumberUnvalidatedComments()
  {
    
    // tableau d'id d'article:  =======================================
    $sql = 'SELECT id FROM Article;';
    $requete = $this->dao->prepare($sql);
    $requete->execute();
    $IdArticleArraytemp = $requete->fetchAll();
    $requete->closeCursor();
    $IdArticleArray = [];
    foreach ($IdArticleArraytemp as $id) {
    	$IdArticleArray[] = $id[0];
	}
    
    
    // tableau d'id de commentaires:  =======================================
    foreach($IdArticleArray as $idArticle){
    	
    	$sql = 'SELECT COUNT(*) FROM comments WHERE id_article = :id_article AND validated = false;';
    	
    	$requete = $this->dao->prepare($sql);
    	$requete->bindValue(':id_article', (int) $idArticle, \PDO::PARAM_INT);
    	$requete->execute();
    	$NumberComment = $requete->fetchAll();
    	$requete->closeCursor();
    	$NumberCommentArray[$idArticle] = $NumberComment[0]['COUNT(*)'];
    }
    
    return $NumberCommentArray;
    
  }
  
  
  
  public function getCountCommentById($id_article)
  {
    
    $sql = 'SELECT COUNT(*) FROM comments WHERE id_article = :id_article;';


    $requete = $this->dao->prepare($sql);
    $requete->bindValue(':id_article', (int) $id_article, \PDO::PARAM_INT);
    $requete->execute();
 
    $array_nombre_article = $requete->fetchAll();
    $nombre_article = $array_nombre_article[0][0];
    
    
    $requete->closeCursor();
 
    return $nombre_article;
    
  }
  
  
  public function getCountValidatedCommentById($id_article)
  {
    
    $sql = 'SELECT COUNT(*) FROM comments WHERE id_article = :id_article AND validated = true;';
    

    $requete = $this->dao->prepare($sql);
    $requete->bindValue(':id_article', (int) $id_article, \PDO::PARAM_INT);
    $requete->execute();
 
    $array_nombre_article = $requete->fetchAll();
    $nombre_article = $array_nombre_article[0][0];
    
    
    $requete->closeCursor();
 
    return $nombre_article;
    
  }
  
  
  public function getCountUnvalidatedCommentById($id_article)
  {
    
    $sql = 'SELECT COUNT(*) FROM comments WHERE id_article = :id_article AND validated = false;';
    
    $requete = $this->dao->prepare($sql);
    $requete->bindValue(':id_article', (int) $id_article, \PDO::PARAM_INT);
    $requete->execute();
 
    $array_nombre_article = $requete->fetchAll();
    $nombre_article = $array_nombre_article[0][0];
    
    $requete->closeCursor();
 
    return $nombre_article;
    
  }
  
 
  public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT id, titre, depart, arrivee, contenu, dateAjout, dateModif FROM article WHERE id = :id');
    $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $requete->execute();
 
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Articles');
 	
 	date_default_timezone_set('Europe/Paris');
    if ($article = $requete->fetch())
    {
      $article->setDateAjout(new \DateTime($article->dateAjout()));
      $article->setDateModif(new \DateTime($article->dateModif()));
 
      return $article;
    }
 
    return null;
  }
 
 
 
  protected function modify(Articles $art)
  {
    $requete = $this->dao->prepare('UPDATE article SET depart = :depart, arrivee = :arrivee, contenu = :contenu, dateModif = NOW() WHERE id = :id');
 
    $requete->bindValue(':depart', $art->depart());
    $requete->bindValue(':arrivee', $art->arrivee());
    $requete->bindValue(':contenu', $art->contenu());
    $requete->bindValue(':id', $art->id(), \PDO::PARAM_INT);
 
    $requete->execute();
  }
  
  
  
  public function getDepartures()
  {
    
    $sql = 'SELECT DISTINCT depart FROM article;';
    

    $requete = $this->dao->prepare($sql);
    $requete->execute();
 
    $depart_temp = $requete->fetchAll();
    $depart = [];
    foreach ($depart_temp as $value)
	{    
		$depart[] =  $value['depart'];
	}
    
    
    $requete->closeCursor();
 
    return $depart;
  }
  
  
  
  public function getArrivals()
  {
    $sql = 'SELECT DISTINCT arrivee FROM article;';
    

    $requete = $this->dao->prepare($sql);
    $requete->execute();
    
    $arrivee_temp = $requete->fetchAll();
    $arrivee = [];
    foreach ($arrivee_temp as $value)
	{    
		$arrivee[] =  $value['arrivee'];
	}
    
    
    $requete->closeCursor();
 	
    return $arrivee;
  }
  
  
  
  public function getArticlesByDepartureAndArrival($departure, $arrival)
  {
    
    
    $sql = 'SELECT DISTINCT id FROM article WHERE depart = :d AND arrivee = :a;';
    

    $requete = $this->dao->prepare($sql);
    $requete->bindValue(':d', $departure);
    $requete->bindValue(':a', $arrival);
    $requete->execute();
 
    $id_temp = $requete->fetchAll();
    
    
    $id_article = [];
    foreach($id_temp as $value)
    {
    	$id_article[] = $value['id'];
    }
    
    $requete->closeCursor();
 
    return $id_article;
  }
  
  
}


















