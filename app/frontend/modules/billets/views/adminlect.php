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
		<header>
			<?php
				include("layout/header.php");
			?>
			<div>
				<h3>Administration du blog</h3>
			</div>
		</header>
		<div id="blocPrincipal" class="col-md-12">
			
			<section id="sectPrincBillet" class="col-md-10">
			
				<h4><?= $billet["titre"]; ?></h4>
				<p><?= $billet["contenu"]; ?> </p>
				
				<div id="modifBilletAdminlect">
					<a href="">Modifier le billet</a>
				</div>
				<div id="supprBilletAdminlect">
					<a href="">Supprimer le billet</a>
				</div>
				<div id="retourAdmin">
					<a href="<?= "index.php?page=admin"; ?>">Retour à l'interface d'administration</a>					
				</div>
				<div id="precSuiv">

				</div>
			</section>
			
		</div>
		<footer class="col-md-12">
				<?php
				include("layout/footer.php");
				?>
		</footer>
		<?php
		include_once("layout/scripts.php");
		?>	
	</body>
</html>