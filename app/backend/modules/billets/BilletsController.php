<?php
namespace app\backend\modules\billets;
 
use \fram\BackController;
use \fram\HTTPRequest;
use entity\Billets;
use \entity\Comment;
 
class BilletsController extends BackController
{
  public function executeDelete(HTTPRequest $request)
  {
    $billetsId = $request->getData('id');
 
    $this->managers->getManagerOf('Billets')->delete($billetsId);
    $this->managers->getManagerOf('Comments')->deleteFromBillets($billetsId);
 
    $this->app->user()->setFlash('le billets a bien été supprimée !');
 
    $this->app->httpResponse()->redirect('.');
  }
 
  public function executeDeleteComment(HTTPRequest $request)
  {
    $this->managers->getManagerOf('Comments')->delete($request->getData('id'));
 
    $this->app->user()->setFlash('Le commentaire a bien été supprimé !');
 
    $this->app->httpResponse()->redirect('.');
  }
 
  public function executeIndex(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Gestion des billets');
 
    $manager = $this->managers->getManagerOf('Billets');
 
    $this->page->addVar('listeBillets', $manager->getList());
    $this->page->addVar('nombreBillets', $manager->count());
  }
 
  public function executeInsert(HTTPRequest $request)
  {
    if ($request->postExists('auteur'))
    {
      $this->processForm($request);
    }
 
    $this->page->addVar('title', 'Ajout d\'une billets');
  }
 
  public function executeUpdate(HTTPRequest $request)
  {
    if ($request->postExists('auteur'))
    {
      $this->processForm($request);
    }
    else
    {
      $this->page->addVar('billets', $this->managers->getManagerOf('Billets')->getUnique($request->getData('id')));
    }
 
    $this->page->addVar('title', 'Modification d\'une billets');
  }
 
  public function executeUpdateComment(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Modification d\'un commentaire');
 
    if ($request->postExists('pseudo'))
    {
      $comment = new Comment([
        'id' => $request->getData('id'),
        'auteur' => $request->postData('pseudo'),
        'contenu' => $request->postData('contenu')
      ]);
 
      if ($comment->isValid())
      {
        $this->managers->getManagerOf('Comments')->save($comment);
 
        $this->app->user()->setFlash('Le commentaire a bien été modifié !');
 
        $this->app->httpResponse()->redirect('/billets-'.$request->postData('billets').'.html');
      }
      else
      {
        $this->page->addVar('erreurs', $comment->erreurs());
      }
 
      $this->page->addVar('comment', $comment);
    }
    else
    {
      $this->page->addVar('comment', $this->managers->getManagerOf('Comments')->get($request->getData('id')));
    }
  }
 
  public function processForm(HTTPRequest $request)
  {
    $billets = new Billets([
      'auteur' => $request->postData('auteur'),
      'titre' => $request->postData('titre'),
      'contenu' => $request->postData('contenu')
    ]);
 
    // L'identifiant du billet est transmis si on veut le modifier.
    if ($request->postExists('id'))
    {
      $billets->setId($request->postData('id'));
    }
 
    if ($billets->isValid())
    {
      $this->managers->getManagerOf('Billets')->save($billets);
 
      $this->app->user()->setFlash($billets->isNew() ? 'le billets a bien été ajoutée !' : 'le billets a bien été modifiée !');
    }
    else
    {
      $this->page->addVar('erreurs', $billets->erreurs());
    }
 
    $this->page->addVar('billets', $billets);
  }
}