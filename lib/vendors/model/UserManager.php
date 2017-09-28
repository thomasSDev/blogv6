<?php
namespace model;
 
use \fram\Manager;
use \entity\User;
 
abstract class UserManager extends Manager
{
  
  /**
   * Méthode permettant d'enregistrer une User.
   * @param $User User le billet à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function save(User $user)
  {
    if ($user->isValid())
    {
      $user->isNew() ? $this->add($user) : $this->modify($user);
    }
    else
    {
      throw new \RuntimeException('le billet doit être validée pour être enregistrée');
    }
  }
 
  
 
  /**
   * Méthode retournant une user précise.
   * @param $id int L'identifiant du billet à récupérer
   * @return user le user demandée
   */
  abstract public function getUnique(User $user);
 
   /**
   * Méthode retournant une liste de user demandée.
   * @param $debut int le première user à sélectionner
   * @param $limite int Le nombre de user à sélectionner
   * @return array le liste des user. Chaque entrée est une instance de user.
   */
  abstract public function getList($debut = -1, $limite = -1);
 
  /**
   * Méthode permettant de modifier une user.
   * @param $user le billet à modifier
   * @return void
   */
  abstract protected function modify(User $user);
}