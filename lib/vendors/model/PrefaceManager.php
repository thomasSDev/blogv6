<?php
namespace model;
 
use \fram\Manager;
use \entity\Preface;
 
abstract class PrefaceManager extends Manager
{
  
  /**
   * Méthode permettant d'enregistrer une preface.
   * @param $preface preface le billet à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function save(Preface $preface)
  {
    if ($preface->isValid())
    {
      $preface->isNew() ? $this->add($preface) : $this->modify($preface);
    }
    else
    {
      throw new \RuntimeException('le billet doit être validée pour être enregistrée');
    }
  }
 
  
 
  /**
   * Méthode retournant une preface précise.
   * @param $id int L'identifiant du billet à récupérer
   * @return preface le preface demandée
   */
  abstract public function getUnique(Preface $preface);
 
   /**
   * Méthode retournant une liste de billets demandée.
   * @param $debut int le première billets à sélectionner
   * @param $limite int Le nombre de billets à sélectionner
   * @return array le liste des billets. Chaque entrée est une instance de billets.
   */
  abstract public function getList($debut = -1, $limite = -1);
 
  /**
   * Méthode permettant de modifier une preface.
   * @param $preface le billet à modifier
   * @return void
   */
  abstract protected function modify(Preface $preface);
}