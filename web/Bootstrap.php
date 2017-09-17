<?php
const DEFAULT_APP = 'frontend';
 
// Si l'application n'est pas valide, on va charger l'application par défaut qui se chargera de générer une erreur 404
if (!isset($_GET['app']) || !file_exists(__DIR__.'/../app/'.$_GET['app'])) $_GET['app'] = DEFAULT_APP;
 
// On commence par inclure la classe nous permettant d'enregistrer nos autoload
require __DIR__.'/../lib/fram/SplClassLoader.php';
 
// On va ensuite enregistrer les autoloads correspondant à chaque vendor (fram, app, model, etc.)
$OCFramLoader = new SplClassLoader('fram', __DIR__.'/../lib');
$OCFramLoader->register();
 
$appLoader = new SplClassLoader('app', __DIR__.'/..');
$appLoader->register();
 
$modelLoader = new SplClassLoader('model', __DIR__.'/../lib/vendors');
$modelLoader->register();
 
$entityLoader = new SplClassLoader('entity', __DIR__.'/../lib/vendors');
$entityLoader->register();
 
// Il ne nous suffit plus qu'à déduire le nom de la classe et à l'instancier
$appClass = 'app\\'.$_GET['app'].'\\'.$_GET['app'].'application';
 
$app = new $appClass;
$app->run();