<?php
const DEFAULT_APP = 'frontend';
define("DS", DIRECTORY_SEPARATOR);
define("ROOT", dirname(__DIR__));
define("VENDORS", ROOT.DS."lib\\vendors");
// Si l'application n'est pas valide, on va charger l'application par défaut qui se chargera de générer une erreur 404
if (!isset($_GET['app']) || !file_exists(__DIR__.'/../app/'.$_GET['app'])) $_GET['app'] = DEFAULT_APP;
 
// On commence par inclure la classe nous permettant d'enregistrer nos autoload
require __DIR__.'/../lib/fram/SplClassLoader.php';
 
// On va ensuite enregistrer les autoloads correspondant à chaque vendor (fram, app, model, etc.)
$framLoader = new SplClassLoader('fram', __DIR__.'/../lib');
$framLoader->register();
 
$appLoader = new SplClassLoader('app', __DIR__.'/..');
$appLoader->register();
 
$modelLoader = new SplClassLoader('model', VENDORS.DS.'');
$modelLoader->register();
 
$entityLoader = new SplClassLoader('entity', VENDORS.DS.'');
$entityLoader->register();

$entityLoader = new SplClassLoader('formBuilder', VENDORS.DS.'');
$entityLoader->register();

// Il ne nous suffit plus qu'à déduire le nom de la classe et à l'instancier
$appClass = 'app\\'.$_GET['app'].'\\'.$_GET['app'].'Application';
 
$app = new $appClass;
$app->run();