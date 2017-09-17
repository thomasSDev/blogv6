<?php 

?>


<h3>Introduction</h3>

<div id="texteIntro">	<?php


foreach ($listeIntro as $intro)
{
?>
  <h2><?= $intro['titre'] ?></a></h2>
  <p><?= nl2br($intro['contenu']) ?></p>
<?php
}
?></div>