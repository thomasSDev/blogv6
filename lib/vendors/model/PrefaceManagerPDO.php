<?php
namespace model;
 
use \entity\Preface;
 
class PrefaceManagerPDO extends PrefaceManager
{

  public function getUnique(Preface $preface)
  {
    $requete = $this->dao->prepare('SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM preface');
    $requete->bindValue(':titre', $preface->titre());
    $requete->bindValue(':auteur', $preface->auteur());
    $requete->bindValue(':contenu', $preface->contenu());
    $preface = $requete->fetch();
 
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\entity\Preface');
 

  }
    public function getList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM preface';
 
    if ($debut != -1 || $limite != -1)
    {
      $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
    }
 
    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\entity\Preface');
 
    $listePreface = $requete->fetchAll();
 
    foreach ($listePreface as $preface)
    {
      $preface->setDateAjout(new \DateTime($preface->dateAjout()));
      $preface->setDateModif(new \DateTime($preface->dateModif()));
    }
 
    $requete->closeCursor();
 
    return $listePreface;
  }
 
 
  protected function modify(Preface $preface)
  {
    $requete = $this->dao->prepare('UPDATE preface SET auteur = :auteur, titre = :titre, contenu = :contenu, dateModif = NOW() WHERE id = :id');
 
    $requete->bindValue(':titre', $preface->titre());
    $requete->bindValue(':auteur', $preface->auteur());
    $requete->bindValue(':contenu', $preface->contenu());
    $requete->bindValue(':id', $preface->id(), \PDO::PARAM_INT);
 
    $requete->execute();
  }
}