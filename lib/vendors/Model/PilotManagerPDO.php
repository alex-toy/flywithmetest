<?php
namespace Model;
 
use \Entity\Pilot;
 
class PilotManagerPDO extends PilotManager
{
  
  protected function add(Pilot $pilot)
  {
    //echo 'PilotManagerPDO->add<br>';
    
	$requete = $this->dao->prepare('INSERT INTO pilot SET pilotname = :pilotname, email = :email,  registered = false, pwrd = :pwrd;');
	
	$requete->bindValue(':pilotname', $pilot->pilotname());
	$requete->bindValue(':email', $pilot->email());
	$requete->bindValue(':pwrd', $pilot->pwrd());
	$requete->execute();
	$requete->closeCursor();
		
  }
  
  
  public function HasUniqueName($name)
  {
    //echo 'PilotManagerPDO->HasUniqueName<br>';
    //echo $name;

    $sql = 'SELECT pilotname FROM pilot;';
    $requete = $this->dao->prepare($sql);
    $requete->execute();
 
    $array_name_temp = $requete->fetchAll();
    $array_name = [];
    foreach ($array_name_temp as $value)
	{    
		$array_name[] =  $value['pilotname'];
	}
    $requete->closeCursor();
    
    //print_r($array_name);
    //echo $array_name[0];
    if(in_array($name, $array_name)) { return false; }
   	else { return true; }
    
    
  }
  
  
  public function HasUniqueMail($email)
  {
    //echo 'PilotManagerPDO->HasUniqueMail<br>';
    //echo $email;
    

    $sql = 'SELECT email FROM pilot;';
    $requete = $this->dao->prepare($sql);
    $requete->execute();
 
    $array_mail_temp = $requete->fetchAll();
    $array_mail = [];
    foreach ($array_mail_temp as $value)
	{    
		$array_mail[] =  $value['email'];
	}
    $requete->closeCursor();
    
    //print_r($array_mail);
    //echo $array_mail[0];
    if(in_array($email, $array_mail)) { return false; }
   	else { return true; }
    
    
  }
  
  
  public function getAllPilots()
  {
    //echo 'PilotManagerPDO->getAllPilots<br>';

    $sql = 'SELECT * FROM pilot;';
    $requete = $this->dao->prepare($sql);
    $requete->execute();
    $array_name_temp = $requete->fetchAll();
    $requete->closeCursor();
    
    //print_r($array_name_temp);
    return $array_name_temp;
    
  }
  
  
  
  public function getAllCommentsFromPilots($pilotname)
  {
    //echo 'PilotManagerPDO->getAllCommentsFromPilots<br>';

    $sql = 'SELECT comments.contenu AS content, article.titre AS title, comments.validated AS validation, comments.date AS date FROM comments INNER JOIN article ON comments.id_article=article.id WHERE comments.auteur = :pilotname;';

    $requete = $this->dao->prepare($sql);
    $requete->bindValue('pilotname', $pilotname);
    $requete->execute();
    $array_comment_temp = $requete->fetchAll();
    $requete->closeCursor();
    
    //print_r($array_comment_temp);
    return $array_comment_temp;
    
  }
  
  
  
  public function getCountCommentsFromPilots($pilotname)
  {
    //echo 'PilotManagerPDO->getCountCommentsFromPilots<br>';
    
    $AllPilotNames = $this->getAllPilots();
    
    $name_number_array = [];
    for ($i=0; $i<count($AllPilotNames); $i++) {
    	$sql = 'SELECT COUNT(*) FROM comments WHERE comments.auteur = :pilotname;';
    	$requete = $this->dao->prepare($sql);
    	$requete->bindValue('pilotname', $AllPilotNames[$i]['pilotname']);
    	$requete->execute();
    	$numberComments = $requete->fetchAll();
    	$requete->closeCursor();
    	
    	//echo  $numberComments[0][0];
    	//print_r($numberComments);
    	
    	$name_number_array[$AllPilotNames[$i]['pilotname']] = $numberComments[0][0];
	}
		return $name_number_array;
  }
  
  
  
  public function deletePilot($id)
  {
    //echo 'PilotManagerPDO->deletePilot<br>';
    
    $sql = 'DELETE FROM pilot WHERE id = :id;';
    $requete = $this->dao->prepare($sql);
	$requete->bindValue(':id', $id);
	$requete->execute();
	$requete->closeCursor();
    
  }
  
  
  
  public function IsPilot(Pilot $pilot)
  {
    //echo 'PilotManagerPDO->IsPilot<br>';
    
    $pilotname = $pilot->pilotname();
    $pwrd = $pilot->pwrd();

    $sql = 'SELECT * FROM pilot WHERE pilotname = :pilotname AND pwrd = :pwrd;';
    $requete = $this->dao->prepare($sql);
	$requete->bindValue(':pilotname', $pilotname);
	$requete->bindValue(':pwrd', $pwrd);
    $requete->execute();
    $array_name_temp = $requete->fetchAll();
    $requete->closeCursor();
     
    //print_r($array_name_temp);
    return !empty($array_name_temp);
    
  }
  
  
  
  
 
  public function count()
  {
    return $this->dao->query('SELECT COUNT(*) FROM pilot')->fetchColumn();
  }
 
 
 
  public function delete($id)
  {
    $this->dao->exec('DELETE FROM article WHERE id = '.(int) $id);
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
 
      //echo 'id : ' . $id . '<br>';
      //echo 'auteur de l\'article : ' . $article['auteur'] . '<br>';
      //echo 'date ajout de l\'article : ' . $article['dateAjout']->format('d-m-Y') . '<br>';
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
  
  
  
  
  
  
  
  
  
  
  
  
  
  
}


















