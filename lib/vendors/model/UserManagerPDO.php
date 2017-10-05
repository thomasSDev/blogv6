<?php
namespace model;

use \entity\User;
 
class UserManagerPDO extends UserManager
{

  public function getUnique(User $user)
  {
    $request = $this->dao->prepare('SELECT pseudo, passe FROM identifiants WHERE pseudo = :pseudo, passe= :passe');

    $request->bindValue(':pseudo', $user->pseudo());
    $request->bindValue(':passe', $user->passe());
    $user = $request->fetch();

    $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\entity\User');
 
    return $user;
  }
  public function getUser(User $user)
  {
    $request = $this->dao->prepare('SELECT * FROM identifiants WHERE pseudo = :pseudo, passe = :passe');
    
    $request->bindValue(':pseudo', $user->pseudo());
    $request->bindValue(':passe', $user->passe());
    $request->fetch();
 
    $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\entity\User');
 
    
  }
    public function getList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT id, pseudo, passe FROM identifiants';
 
    if ($debut != -1 || $limite != -1)
    {
      $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
    }
 
    $request = $this->dao->query($sql);
    $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\entity\User');
 
    $listeUser = $request->fetchAll();
 
    foreach ($listeUser as $user)
    {
      $user->setDateAjout(new \DateTime($user->dateAjout()));
      $user->setDateModif(new \DateTime($user->dateModif()));
    }
 
    $request->closeCursor();
 
    return $listeUser;
  }
  

 
  protected function modify(User $user)
  {
    $request = $this->dao->prepare('UPDATE identifiants SET pseudo = :pseudo, passe = :passe WHERE id = :id');
 
    $request->bindValue(':pseudo', $user->pseudo());
    $request->bindValue(':passe', $user->passe());
    $request->bindValue(':id', $user->id(), \PDO::PARAM_INT);
 
    $request->execute();
  }
}