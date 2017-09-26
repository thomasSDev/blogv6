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
if ($user->isAuthenticated()) { ?>
<a href="/admin/descriptionAuteur-update-<?= $descriptionAuteur['id'] ?>.html">Modifier la description de l'auteur</a>
<?php
}
?></div>