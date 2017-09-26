<?php 

?>


<h3>Préface</h3>

<div id="preface">
	
	<?php


foreach ($listePreface as $preface)
{
?>
  <h2><?= $preface['titre'] ?></a></h2>
  <p><?= nl2br($preface['contenu']) ?></p>
<?php
}
if ($user->isAuthenticated()) { ?>
          <span><a href="/admin/preface-update-<?= $preface['id'] ?>.html">Modifier la préface</a></span>
<?php
}
?>
</div>
