<?php
namespace model;
 
use \fram\Manager;
use \entity\Intro;
 
abstract class IntroManager extends Manager
{
  
  /**
   * Méthode permettant d'enregistrer une Intro.
   * @param $Intro Intro le billet à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function save(Intro $intro)
  {
    if ($intro->isValid())
    {
      $intro->isNew() ? $this->add($intro) : $this->modify($intro);
    }
    else
    {
      throw new \RuntimeException('le billet doit être validée pour être enregistrée');
    }
  }
 
  
 
  /**
   * Méthode retournant une intro précise.
   * @param $id int L'identifiant du billet à récupérer
   * @return intro le intro demandée
   */
  abstract public function getUnique(Intro $intro);
 
   /**
   * Méthode retournant une liste de intro demandée.
   * @param $debut int le première intro à sélectionner
   * @param $limite int Le nombre de intro à sélectionner
   * @return array le liste des intro. Chaque entrée est une instance de intro.
   */
  abstract public function getList($debut = -1, $limite = -1);
 
  /**
   * Méthode permettant de modifier une intro.
   * @param $intro le billet à modifier
   * @return void
   */
  abstract protected function modify(Intro $intro);
}