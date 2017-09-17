<?php
namespace model;
 
use \entity\Billets;
 
class BilletsManagerPDO extends BilletsManager
{
  protected function add(Billets $billets)
  {
    $requete = $this->dao->prepare('INSERT INTO billets SET auteur = :auteur, titre = :titre, contenu = :contenu, dateAjout = NOW(), dateModif = NOW()');
 
    $requete->bindValue(':titre', $billets->titre());
    $requete->bindValue(':auteur', $billets->auteur());
    $requete->bindValue(':contenu', $billets->contenu());
 
    $requete->execute();
  }
 
  public function count()
  {
    return $this->dao->query('SELECT COUNT(*) FROM billets')->fetchColumn();
  }
 
  public function delete($id)
  {
    $this->dao->exec('DELETE FROM billets WHERE id = '.(int) $id);
  }
 
  public function getList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM billets ORDER BY id DESC';
 
    if ($debut != -1 || $limite != -1)
    {
      $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
    }
 
    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\entity\Billets');
 
    $listeBillets = $requete->fetchAll();
 
    foreach ($listeBillets as $billets)
    {
      $billets->setDateAjout(new \DateTime($billets->dateAjout()));
      $billets->setDateModif(new \DateTime($billets->dateModif()));
    }
 
    $requete->closeCursor();
 
    return $listeBillets;
  }
 
  public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM billets WHERE id = :id');
    $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $requete->execute();
 
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\entity\Billets');
 
    if ($billets = $requete->fetch())
    {
      $billets->setDateAjout(new \DateTime($billets->dateAjout()));
      $billets->setDateModif(new \DateTime($billets->dateModif()));
 
      return $billets;
    }
 
    return null;
  }
 
  protected function modify(Billets $billets)
  {
    $requete = $this->dao->prepare('UPDATE billets SET auteur = :auteur, titre = :titre, contenu = :contenu, dateModif = NOW() WHERE id = :id');
 
    $requete->bindValue(':titre', $billets->titre());
    $requete->bindValue(':auteur', $billets->auteur());
    $requete->bindValue(':contenu', $billets->contenu());
    $requete->bindValue(':id', $billets->id(), \PDO::PARAM_INT);
 
    $requete->execute();
  }
}