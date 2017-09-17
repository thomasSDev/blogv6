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
		<header id="headerAccueil" class="col-md-12">
		<?php
			include("layout/header.php");
		?>
		
		</header>
		<div id="blocPrincipal" class="col-md-12">
			
			<section id="sectPrincBillet" class="col-md-10">
			
				<h4><?= $billet["titre"]; ?></h4>
				<p><?= $billet["contenu"]; ?> </p>
				<span><?= $billet["auteur"];?></span>
			
				<div id="precSuiv">

				</div>
			</section>
			
		</div>
		<div id="commentaires">
			<h3>Commentaires</h3>
				<h2>Ajouter un commentaire</h2>
<form action="" method="post">
  <p>
    <?= isset($erreurs) && in_array(\Entity\Comment::AUTEUR_INVALIDE, $erreurs) ? 'L\'auteur est invalide.<br />' : '' ?>
    <label>Pseudo</label>
    <input type="text" name="pseudo" value="<?= isset($comment) ? htmlspecialchars($comment['auteur']) : '' ?>" /><br />
 
    <?= isset($erreurs) && in_array(\Entity\Comment::CONTENU_INVALIDE, $erreurs)) 'Le contenu est invalide.<br />' : '' ?>
    <label>Contenu</label>
    <textarea name="contenu" rows="7" cols="50"><?= isset($comment) ? htmlspecialchars($comment['contenu']) : '' ?></textarea><br />
 
    <input type="submit" value="Commenter" />
  </p>
</form>
		</div>
		<footer  class="col-md-12">
			<?php
				include("layout/footer.php");
			?>
		</footer>
		<?php
		include_once("layout/scripts.php");
		?>		
	</body>
</html>