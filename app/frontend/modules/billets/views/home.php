<?php

session_start();

?>
<!DOCTYPE html>
<html>
	<head>
		<?php
			include_once("layout/head.php");
			?>
	</head>
	<body>
		<header id="headerIndex" class="col-md-12">
			<?php
				include("layout/header.php");
			?>
			<div id="divScrollIndex">
				<i id="doubleDown" class="fa fa-angle-double-down" aria-hidden="true"></i>
			</div>	
		</header>
		<section id="sectDescriptionIndex">
			<h4 id="descriptionIndex"><?=$prefaceTitre?></h4>
			<p><?=$prefaceTexte?></p>
			<a id="lienLireIndex" href="index.php?page=accueil">LIRE LE ROMAN</a>
		</section>
		<footer id="footerIndex" class="col-md-12">
			<?php
				include("layout/footer.php");
			?>
		</footer>
		<?php
		include_once("layout/scripts.php");
		?>
	</body>
</html>