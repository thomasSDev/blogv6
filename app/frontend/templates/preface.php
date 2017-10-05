<?php 

?>


<h3>Préface</h3>

<div id="preface">
	
	<?php


foreach ($listePreface as $preface)
{
?>
  
  <p><?= nl2br($preface['contenu']) ?></p>
<?php
}
?>
</div>