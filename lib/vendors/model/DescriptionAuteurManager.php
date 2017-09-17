<?php
namespace model;
 
use \fram\Manager;
use \entity\DescriptionAuteur;
 
abstract class DescriptionAuteurManager extends Manager
{
  
  /**
   * Méthode permettant d'enregistrer une DescriptionAuteur.
   * @param $DescriptionAuteur DescriptionAuteur le billet à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function save(DescriptionAuteur $descriptionAuteur)
  {
    if ($descriptionAuteur->isValid())
    {
      $descriptionAuteur->isNew() ? $this->add($descriptionAuteur) : $this->modify($descriptionAuteur);
    }
    else
    {
      throw new \RuntimeException('le billet doit être validée pour être enregistrée');
    }
  }
 
  
 
  /**
   * Méthode retournant une descriptionAuteur précise.
   * @param $id int L'identifiant du billet à récupérer
   * @return descriptionAuteur le descriptionAuteur demandée
   */
  abstract public function getUnique(DescriptionAuteur $descriptionAuteur);
 
   /**
   * Méthode retournant une liste de descriptionAuteur demandée.
   * @param $debut int le première descriptionAuteur à sélectionner
   * @param $limite int Le nombre de descriptionAuteur à sélectionner
   * @return array le liste des descriptionAuteur. Chaque entrée est une instance de descriptionAuteur.
   */
  abstract public function getList($debut = -1, $limite = -1);
 
  /**
   * Méthode permettant de modifier une DescriptionAuteur.
   * @param $DescriptionAuteur le descriptionAuteur à modifier
   * @return void
   */
  abstract protected function modify(DescriptionAuteur $descriptionAuteur);
}