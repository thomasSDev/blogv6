<?php
namespace app\frontend\modules\billets;
 
use \fram\BackController;
use \fram\HTTPRequest;
use \entity\Billets;
use \entity\Comments;
use \formBuilder\CommentFormBuilder;
use \formBuilder\BilletsFormBuilder;
use \fram\FormHandler;
 
class BilletsController extends BackController
{
  public function executeIndex(HTTPRequest $request)
  {
    $nombrePreface = $this->app->config()->get('nombre_preface');
   
 
    // On ajoute une définition pour le titre.
    $this->page->addVar('title', 'Liste des '.$nombrePreface.' dernières preface');
 
    // On récupère le manager des preface.
    $manager = $this->managers->getManagerOf('Preface');
 
    $listePreface = $manager->getList(0, 1);
 
    foreach ($listePreface as $preface)
    {

        $debut = substr($preface->contenu(), 0, 10000);
        $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
 
        $preface->setcontenu($debut);
      
    }
 
    // On ajoute la variable $listePreface à la vue.
    $this->page->addVar('listePreface', $listePreface);
  }



  public function executeShow(HTTPRequest $request)
  {
    $manager = $this->managers->getManagerOf('Billets');
    $billet = $manager->getUnique($request->getData('id'));
 
    if (empty($billet))
    {
      $this->app->httpResponse()->redirect404();
    }
 
    $this->page->addVar('titre', $billet->titre());
    $this->page->addVar('billets', $billet);
    $this->page->addVar('comments', $this->managers->getManagerOf('Comments')->getListOf($billet->id()));
  }
 
  public function executeInsertComment(HTTPRequest $request)
  {
    // Si le formulaire a été envoyé.
    if ($request->method() == 'POST')
    {

      $comment = new Comments([
        'billets' => $request->getData('billets'),
        'pseudo' => $request->postData('pseudo'),
        'contenu' => $request->postData('contenu')

      ]);
      
    }
    else
    {
      $comment = new Comments;
    }
 
    $formBuilder = new CommentFormBuilder($comment);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);
 
    if ($formHandler->process())
    {
      $this->app->user()->setFlash('Le commentaire a bien été ajouté, merci !');
 
      $this->app->httpResponse()->redirect('billets-'.$request->getData('billets').'.html');
    }
 
    $this->page->addVar('comments', $comment);
    $this->page->addVar('form', $form->createView());
    $this->page->addVar('title', 'Ajout d\'un commentaire');
  
    }

    public function executeSignalerComment(HTTPRequest $request)
    {
        $manager = $this->managers->getManagerOf('Comments');
        $comment = $manager->get($request->getData('id'));
        $manager->signaler($comment);

        $this->app->user()->setFlash('Le commentaire a bien été signalé, merci !');
        $this->app->httpResponse()->redirect('billets-'.$comment->billets().'.html');
    }

    public function executeAccueil(HTTPRequest $request)
    {

    //Texte d'introduction
    $nombreIntro = $this->app->config()->get('nombre_intro');
   
 
    // On ajoute une définition pour le titre.
    $this->page->addVar('title', 'Liste des '.$nombreIntro.' dernières intro');
 
    // On récupère le manager des intro.
    $manager = $this->managers->getManagerOf('Intro');
 
    $listeIntro = $manager->getList(0, 1);
 
    foreach ($listeIntro as $intro)
    {

        $debut = substr($intro->contenu(), 0, 10000);
        $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
 
        $intro->setcontenu($debut);
      
    }
 
    // On ajoute la variable $listeIntro à la vue.
    $this->page->addVar('listeIntro', $listeIntro);

    //liste des Billets
    $nombreBillets = $this->app->config()->get('nombre_billets');
    $nombreCaracteres = $this->app->config()->get('nombre_caracteres');
 
    // On ajoute une définition pour le titre.
    $this->page->addVar('title', 'Liste des '.$nombreBillets.' dernières billets');
 
    // On récupère le manager des billets.
    $manager = $this->managers->getManagerOf('Billets');
 
    $listeBillets = $manager->getList(0, $nombreBillets);
 
    foreach ($listeBillets as $billets)
    {
      if (strlen($billets->contenu()) > $nombreCaracteres)
      {
        $debut = substr($billets->contenu(), 0, $nombreCaracteres);
        $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
 
        $billets->setcontenu($debut);
      }
    }
 
    // On ajoute la variable $listeBillets à la vue.
    $this->page->addVar('listeBillets', $listeBillets);

    //texte de description de l'auteur
    $nombreDescriptionAuteur = $this->app->config()->get('nombre_descriptionAuteur');
   
 
    // On ajoute une définition pour le titre.
    $this->page->addVar('title', 'Liste des '.$nombreDescriptionAuteur.' dernières descriptionAuteur');
 
    // On récupère le manager des descriptionAuteur.
    $manager = $this->managers->getManagerOf('DescriptionAuteur');
 
    $listeDescriptionAuteur = $manager->getList(0, 1);
 
    foreach ($listeDescriptionAuteur as $descriptionAuteur)
    {

        $debut = substr($descriptionAuteur->contenu(), 0, 10000);
        $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
 
        $descriptionAuteur->setcontenu($debut);
      
    }
 
    // On ajoute la variable $listeDescriptionAuteur à la vue.
    $this->page->addVar('listeDescriptionAuteur', $listeDescriptionAuteur);


  }
}