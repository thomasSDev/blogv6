<?php
namespace entity;

use \fram\Entity;

class Billets extends Entity
{
  protected $pseudo,
            $passe;


  const PSEUDO_INVALIDE = 1;
  const PASSE_INVALIDE = 2;
  
  public function isValid()
  {
    return !(empty($this->pseudo) || empty($this->passe));
  }


  // SETTERS //

  public function setPseudo($pseudo)
  {
    if (!is_string($pseudo) || empty($pseudo))
    {
      $this->erreurs[] = self::PSEUDO_INVALIDE;
    }

    $this->pseudo = $pseudo;
  }

  public function setPasse($passe)
  {
    if (!is_string($passe) || empty($passe))
    {
      $this->erreurs[] = self::PASSE_INVALIDE;
    }

    $this->passe = $passe;
  }

  // GETTERS //

  public function pseudo()
  {
    return $this->pseudo;
  }

  public function passe()
  {
    return $this->passe;
  }

}