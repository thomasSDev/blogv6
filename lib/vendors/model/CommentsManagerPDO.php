<?php
namespace model;
 
use \entity\Comments;
 
class CommentsManagerPDO extends CommentsManager
{
  protected function add(comments $comment)
  {
    $q = $this->dao->prepare('INSERT INTO commentaires SET billets_id = :billets_id, pseudo = :pseudo, contenu = :contenu, dateAjout = NOW()');
 
    $q->bindValue(':billets_id', $comment->billets(), \PDO::PARAM_INT);
    $q->bindValue(':pseudo', $comment->pseudo());
    $q->bindValue(':contenu', $comment->contenu());
 
    $q->execute();
 
    $comment->setId($this->dao->lastInsertId());
  }
 
  public function delete($id)
  {
    $this->dao->exec('DELETE FROM commentaires WHERE id ='.(int) $id);
  }
 
  public function deleteFromBillets($billets)
  {
    $this->dao->exec('DELETE FROM commentaires WHERE billets_id ='.(int) $billets);
  }
 
  public function getListOf($billets)
  {
    if (!ctype_digit($billets))
    {
      throw new \InvalidArgumentException('L\'identifiant du billets passé doit être un nombre entier valide');
    }
 
    $q = $this->dao->prepare('SELECT id, billets_id, pseudo, contenu, dateAjout FROM commentaires WHERE billets_id = :billets_id');
    $q->bindValue(':billets_id', $billets, \PDO::PARAM_INT);
    $q->execute();
 
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\entity\Comments');
 
    $comments = $q->fetchAll();
 
    foreach ($comments as $comment)
    {
      $comment->setDateAjout(new \DateTime($comment->dateAjout()));
    }
 
    return $comments;
  }
 
  protected function modify(comments $comment)
  {
    $q = $this->dao->prepare('UPDATE commentaires SET pseudo = :pseudo, contenu = :contenu WHERE id = :id');
 
    $q->bindValue(':pseudo', $comment->pseudo());
    $q->bindValue(':contenu', $comment->contenu());
    $q->bindValue(':id', $comment->id(), \PDO::PARAM_INT);
 
    $q->execute();
  }
 
  public function get($id)
  {
    $q = $this->dao->prepare('SELECT id, pseudo, contenu, dateAjout FROM commentaires WHERE id = :id');
    $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $q->execute();
 
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\entity\Comments');
 
    return $q->fetch();
  }
}