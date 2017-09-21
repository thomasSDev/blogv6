<?php $monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
echo $monUrl;     
?>

<!DOCTYPE html>
<html>
  <head>
    <?php include_once("head.php");?>
  </head>

  <body>
    <header>
      <?php include_once("header.php");  ?>
    </header>
    <div id="preface">
      <?php if($monUrl == "http://localhost/"){ 

        include_once("preface.php");
      }
      ?>
    </div>
    <div id="intro">
      <?php if($monUrl == "http://localhost/accueil.html"){ 

        include_once("intro.php");
      }
      ?>
    </div>  

    <div id="wrap">
      
 
      <nav>
        <ul>
          <?php if ($user->isAuthenticated()) { ?>
          <li><a href="/admin/">Admin</a></li>
          <li><a href="/admin/billets-insert.html">Ajouter un billet</a></li>
          <?php } ?>
        </ul>
      </nav>
 
      <div id="content-wrap">
        <section id="main">
          <?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>
 
          <?= $content ?>
        </section>
      </div>
    <div id="descriptionAuteurLayout">
      <?php if($monUrl == "http://localhost/accueil.html"){ 

        include_once("descriptionAuteur.php");
      }
      ?>
    </div>  
      <footer>
        <?php include_once("footer.php"); ?>
      </footer>
    </div>
  </body>
</html>