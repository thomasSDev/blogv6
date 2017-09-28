<?php
namespace model;
 
use \entity\User;
 
class UserManagerPDO extends UserManager
{

  public function getUnique(User $user)
  {
    $requete = $this->dao->prepare('SELECT id, pseudo, passe FROM identifiants');
    $requete->bindValue(':titre', $user->titre());
    $requete->bindValue(':auteur', $user->auteur());
    $requete->bindValue(':contenu', $user->contenu());
    $user = $requete->fetch();
 
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\entity\User');
 

  }
    public function getList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT id, pseudo, passe FROM identifiants';
 
    if ($debut != -1 || $limite != -1)
    {
      $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
    }
 
    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\entity\User');
 
    $listeUser = $requete->fetchAll();
 
    foreach ($listeUser as $user)
    {
      $user->setDateAjout(new \DateTime($user->dateAjout()));
      $user->setDateModif(new \DateTime($user->dateModif()));
    }
 
    $requete->closeCursor();
 
    return $listeUser;
  }
  
    public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT id, pseudo, passe FROM identifiants WHERE id = :id');
    $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $requete->execute();
 
    $preface = $requete->fetch();
 
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\entity\User');
  }
 
  protected function modify(User $user)
  {
    $requete = $this->dao->prepare('UPDATE identifiants SET pseudo = :pseudo, passe = :passe WHERE id = :id');
 
    $requete->bindValue(':pseudo', $user->pseudo());
    $requete->bindValue(':passe', $user->passe());
    $requete->bindValue(':id', $user->id(), \PDO::PARAM_INT);
 
    $requete->execute();
  }
}