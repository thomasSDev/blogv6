<?php
namespace model;
 
use \entity\Intro;
 
class IntroManagerPDO extends IntroManager
{

  public function getUnique(Intro $intro)
  {
    $requete = $this->dao->prepare('SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM intro');
    $requete->bindValue(':titre', $intro->titre());
    $requete->bindValue(':auteur', $intro->auteur());
    $requete->bindValue(':contenu', $intro->contenu());
    $intro = $requete->fetch();
 
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\entity\Intro');
 

  }
    public function getList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM intro';
 
    if ($debut != -1 || $limite != -1)
    {
      $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
    }
 
    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\entity\Intro');
 
    $listeIntro = $requete->fetchAll();
 
    foreach ($listeIntro as $intro)
    {
      $intro->setDateAjout(new \DateTime($intro->dateAjout()));
      $intro->setDateModif(new \DateTime($intro->dateModif()));
    }
 
    $requete->closeCursor();
 
    return $listeIntro;
  }
 
 
  protected function modify(Intro $intro)
  {
    $requete = $this->dao->prepare('UPDATE intro SET auteur = :auteur, titre = :titre, contenu = :contenu, dateModif = NOW() WHERE id = :id');
 
    $requete->bindValue(':titre', $intro->titre());
    $requete->bindValue(':auteur', $intro->auteur());
    $requete->bindValue(':contenu', $intro->contenu());
    $requete->bindValue(':id', $intro->id(), \PDO::PARAM_INT);
 
    $requete->execute();
  }
      public function get($id)
  {
    $q = $this->dao->prepare('SELECT id, auteur, contenu, dateAjout FROM intro WHERE id = :id');
    $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $q->execute();
 
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\entity\Intro');
 
    return $q->fetch();
  }
}