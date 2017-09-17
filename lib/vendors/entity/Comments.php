<?php
namespace entity;
 
use \fram\entity;
 
class Comments extends Entity
{
  protected $billets,
            $pseudo,
            $contenu,
            $dateAjout;
 
  const PSEUDO_INVALIDE = 1;
  const CONTENU_INVALIDE = 2;
 
  public function isValid()
  {
    return !(empty($this->pseudo) || empty($this->contenu));
  }
 
  public function setBillets($billets)
  {
    $this->billets = (int) $billets;
  }
 
  public function setPseudo($pseudo)
  {
    if (!is_string($pseudo) || empty($pseudo))
    {
      $this->erreurs[] = self::PSEUDO_INVALIDE;
    }
 
    $this->pseudo = $pseudo;
  }
 
  public function setContenu($contenu)
  {
    if (!is_string($contenu) || empty($contenu))
    {
      $this->erreurs[] = self::CONTENU_INVALIDE;
    }
 
    $this->contenu = $contenu;
  }
 
  public function setDateAjout(\DateTime $dateAjout)
  {
    $this->dateAjout = $dateAjout;
  }
 
  public function billets()
  {
    return $this->billets;
  }
 
  public function pseudo()
  {
    return $this->pseudo;
  }
 
  public function contenu()
  {
    return $this->contenu;
  }
 
  public function dateAjout()
  {
    return $this->dateAjout;
  }
}