<?php
namespace app\backend\modules\connexion;
 
use \fram\BackController;
use \fram\HTTPRequest;
use \entity\User;
use \model\UserManager;
use \model\UserManagerPDO;
 
class ConnexionController extends BackController
{
  public function executeIndex(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Connexion');
 
    $manager = $this->managers->getManagerOf('User');

    if (($request->postExists('login')) && ($request->postExists('password')))
    {
      $login = $request->postData('login');
      $password = $request->postData('password');

      $user = new User([
        'pseudo' => $request->getData('pseudo'),
        'password' => $request->getData('passe')

      ]);
      
      
      
      var_dump($user);
           

      if ($login == $user->pseudo('pseudo') && ($password == $user->passe('passe')))
      {

        $this->app->user()->setAuthenticated(true);
        $this->app->httpResponse()->redirect('.');
      }
      else
      {
        $this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect.');
      }
    }
  }
}