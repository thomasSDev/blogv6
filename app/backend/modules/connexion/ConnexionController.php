<?php
namespace app\backend\modules\connexion;
 
use \fram\BackController;
use \fram\HTTPRequest;
use \entity\User;
use \model\ManagerUser;
use \model\ManagerUserPDO;
 
class ConnexionController extends BackController
{
  public function executeIndex(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Connexion');
 
    if ($request->postExists('login'))
    {
      $login = $request->postData('login');
      $password = $request->postData('password');
 
      if ($login == $this->managers->addVar('pseudo')) && $password == $this->managers->addVar('passe'))
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