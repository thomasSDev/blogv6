<?php 

?>


<h3>Présentation de l'auteur</h3>

<div id="descriptionAuteur">	<?php


foreach ($listeDescriptionAuteur as $descriptionAuteur)
{
?>
  <h2><?= $descriptionAuteur['titre'] ?></a></h2>
  <p><?= nl2br($descriptionAuteur['contenu']) ?></p>
<?php
}
?></div>