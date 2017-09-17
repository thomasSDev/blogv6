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
?>
</div>