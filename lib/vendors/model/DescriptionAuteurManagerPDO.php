<?php
namespace model;
 
use \entity\DescriptionAuteur;
 
class DescriptionAuteurManagerPDO extends DescriptionAuteurManager
{

  public function getUnique(DescriptionAuteur $descriptionAuteur)
  {
    $requete = $this->dao->prepare('SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM description_auteur');
    $requete->bindValue(':titre', $descriptionAuteur->titre());
    $requete->bindValue(':auteur', $descriptionAuteur->auteur());
    $requete->bindValue(':contenu', $descriptionAuteur->contenu());
    $descriptionAuteur = $requete->fetch();
 
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\entity\DescriptionAuteur');
 

  }
    public function getList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM description_auteur';
 
    if ($debut != -1 || $limite != -1)
    {
      $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
    }
 
    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\entity\DescriptionAuteur');
 
    $listeDescriptionAuteur = $requete->fetchAll();
 
    foreach ($listeDescriptionAuteur as $descriptionAuteur)
    {
      $descriptionAuteur->setDateAjout(new \DateTime($descriptionAuteur->dateAjout()));
      $descriptionAuteur->setDateModif(new \DateTime($descriptionAuteur->dateModif()));
    }
 
    $requete->closeCursor();
 
    return $listeDescriptionAuteur;
  }
 
 
  protected function modify(DescriptionAuteur $descriptionAuteur)
  {
    $requete = $this->dao->prepare('UPDATE description_auteur SET auteur = :auteur, titre = :titre, contenu = :contenu, dateModif = NOW() WHERE id = :id');
 
    $requete->bindValue(':titre', $descriptionAuteur->titre());
    $requete->bindValue(':auteur', $descriptionAuteur->auteur());
    $requete->bindValue(':contenu', $descriptionAuteur->contenu());
    $requete->bindValue(':id', $descriptionAuteur->id(), \PDO::PARAM_INT);
 
    $requete->execute();
  }
      public function get($id)
  {
    $q = $this->dao->prepare('SELECT id, auteur, contenu, dateAjout FROM description_auteur WHERE id = :id');
    $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $q->execute();
 
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\entity\DescriptionAuteur');
 
    return $q->fetch();
  }
}