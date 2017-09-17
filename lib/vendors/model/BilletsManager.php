<?php
namespace model;
 
use \fram\Manager;
use \entity\Billets;
 
abstract class BilletsManager extends Manager
{
  /**
   * Méthode permettant d'ajouter une billets.
   * @param $billets le billet à ajouter
   * @return void
   */
  abstract protected function add(Billets $billets);
 
  /**
   * Méthode permettant d'enregistrer une billets.
   * @param $billets billets le billet à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function save(Billets $billets)
  {
    if ($billets->isValid())
    {
      $billets->isNew() ? $this->add($billets) : $this->modify($billets);
    }
    else
    {
      throw new \RuntimeException('le billet doit être validée pour être enregistrée');
    }
  }
 
  /**
   * Méthode renvoyant le nombre de billets total.
   * @return int
   */
  abstract public function count();
 
  /**
   * Méthode permettant de supprimer une billets.
   * @param $id int L'identifiant du billet à supprimer
   * @return void
   */
  abstract public function delete($id);
 
  /**
   * Méthode retournant une liste de billets demandée.
   * @param $debut int le première billets à sélectionner
   * @param $limite int Le nombre de billets à sélectionner
   * @return array le liste des billets. Chaque entrée est une instance de billets.
   */
  abstract public function getList($debut = -1, $limite = -1);
 
  /**
   * Méthode retournant une billets précise.
   * @param $id int L'identifiant du billet à récupérer
   * @return billets le billets demandée
   */
  abstract public function getUnique($id);
 
  /**
   * Méthode permettant de modifier une billets.
   * @param $billets le billet à modifier
   * @return void
   */
  abstract protected function modify(Billets $billets);
}