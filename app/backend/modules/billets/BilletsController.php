<?php
namespace app\backend\modules\billets;
 
use \fram\BackController;
use \fram\HTTPRequest;
use \entity\Billets;
use \entity\Comments;
use \entity\Preface;
use \entity\Intro;
use \entity\DescriptionAuteur;
use \formBuilder\PrefaceFormBuilder;
use \formBuilder\IntroFormBuilder;
use \formBuilder\DescriptionAuteurFormBuilder;
use \formBuilder\CommentFormBuilder;
use \formBuilder\BilletsFormBuilder;
use \fram\FormHandler;
 
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
 
    $this->page->addVar('title', 'Ajout d\'un billet');
  }

  
  public function executeUpdate(HTTPRequest $request)
  {
    $this->processForm($request);
 
    $this->page->addVar('title', 'Modification d\'un billet');
  }
 
  public function executeUpdateComment(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Modification d\'un commentaire');
 
    if ($request->method() == 'POST')
    {
      $comment = new Comments([
        'id' => $request->getData('id'),
        'pseudo' => $request->postData('pseudo'),
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
  public function executeUpdatePreface(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Modification de la préface');
 
    if ($request->method() == 'POST')
    {
      $preface = new Preface([
        'id' => $request->getData('id'),
        'auteur' => $request->postData('auteur'),
        'contenu' => $request->postData('contenu')
      ]);
    }
    else
    {
      $preface = $this->managers->getManagerOf('Preface')->get($request->getData('id'));
    }
 
    $formBuilder = new PrefaceFormBuilder($preface);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Preface'), $request);
 
    if ($formHandler->process())
    {
      $this->app->user()->setFlash('La préface a bien été modifié');
 
      $this->app->httpResponse()->redirect('/admin/');
    }
 
    $this->page->addVar('form', $form->createView());
  }
  public function executeUpdateIntro(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Modification de l\'introduction');
 
    if ($request->method() == 'POST')
    {
      $preface = new Intro([
        'id' => $request->getData('id'),
        'auteur' => $request->postData('auteur'),
        'contenu' => $request->postData('contenu')
      ]);
    }
    else
    {
      $preface = $this->managers->getManagerOf('Intro')->get($request->getData('id'));
    }
 
    $formBuilder = new IntroFormBuilder($preface);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Intro'), $request);
 
    if ($formHandler->process())
    {
      $this->app->user()->setFlash('Le texte d\'introduction a bien été modifié');
 
      $this->app->httpResponse()->redirect('/admin/');
    }
 
    $this->page->addVar('form', $form->createView());
  }
  public function executeUpdateDescriptionAuteur(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Modification de la description de l\'auteur');
 
    if ($request->method() == 'POST')
    {
      $preface = new DescriptionAuteur([
        'id' => $request->getData('id'),
        'auteur' => $request->postData('auteur'),
        'contenu' => $request->postData('contenu')
      ]);
    }
    else
    {
      $preface = $this->managers->getManagerOf('DescriptionAuteur')->get($request->getData('id'));
    }
 
    $formBuilder = new DescriptionAuteurFormBuilder($preface);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Intro'), $request);
 
    if ($formHandler->process())
    {
      $this->app->user()->setFlash('Le texte de la description de l\'auteur a bien été modifié');
 
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
      // L'identifiant du billets est transmis si on veut le modifier
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












