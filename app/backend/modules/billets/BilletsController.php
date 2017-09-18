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
    $this->processForm($request);

    $this->page->addVar('title', 'Ajout d\'une news');
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
 
    if ($request->method() == 'POST')
    {
      $comment = new Comment([
        'id' => $request->getData('id'),
        'auteur' => $request->postData('auteur'),
        'contenu' => $request->postData('contenu')
      ]);
    }
    else
    {
      $comment = $this->managers->getManagerOf('Comments')->get($request->getData('id'));
    }
 
    $formBuilder = new CommentFormBuilder($comment);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);
 
    if ($formHandler->process())
    {
      $this->app->user()->setFlash('Le commentaire a bien été modifié');
 
      $this->app->httpResponse()->redirect('/admin/');
    }
 
    $this->page->addVar('form', $form->createView());
  }
 
  public function processForm(HTTPRequest $request)
  {
    if ($request->method() == 'POST')
    {
      $billets = new Billets([
        'auteur' => $request->postData('auteur'),
        'titre' => $request->postData('titre'),
        'contenu' => $request->postData('contenu')
      ]);
 
      if ($request->getExists('id'))
      {
        $billets->setId($request->getData('id'));
      }
    }
    else
    {
      // L'identifiant de la billets est transmis si on veut la modifier
      if ($request->getExists('id'))
      {
        $billets = $this->managers->getManagerOf('Billets')->getUnique($request->getData('id'));
      }
      else
      {
        $billets = new Billets;
      }
    }
 
    $formBuilder = new BilletsFormBuilder($billets);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Billets'), $request);
 
    if ($formHandler->process())
    {
      $this->app->user()->setFlash($billets->isNew() ? 'Le Billets a bien été ajoutée !' : 'Le Billets a bien été modifiée !');
 
      $this->app->httpResponse()->redirect('/admin/');
    }
 
    $this->page->addVar('form', $form->createView());
  }
}