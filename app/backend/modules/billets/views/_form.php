<form action="" method="post">
  <p>
    <?= isset($erreurs) && in_array(\entity\Billets::AUTEUR_INVALIDE, $erreurs) ? 'L\'auteur est invalide.<br />' : '' ?>
    <label>Auteur</label>
    <input type="text" name="auteur" value="<?= isset($billets) ? $billets['auteur'] : '' ?>" /><br />
 
    <?= isset($erreurs) && in_array(\entity\Billets::TITRE_INVALIDE, $erreurs) ? 'Le titre est invalide.<br />' : '' ?>
    <label>Titre</label><input type="text" name="titre" value="<?= isset($billets) ? $billets['titre'] : '' ?>" /><br />
 
    <?= isset($erreurs) && in_array(\entity\Billets::CONTENU_INVALIDE, $erreurs) ? 'Le contenu est invalide.<br />' : '' ?>
    <label>Texte</label><textarea rows="8" cols="60" name="contenu"><?= isset($billets) ? $billets['contenu'] : '' ?></textarea><br />
<?php
if(isset($billets) && !$billets->isNew())
{
?>
    <input type="hidden" name="id" value="<?= $billets['id'] ?>" />
    <input type="submit" value="Modifier" name="modifier" />
<?php
}
else
{
?>
    <input type="submit" value="Ajouter" />
<?php
}
?>
  </p>
</form>


<h2>Ajouter un billet</h2>
<form action="" method="post">
  <p>
    <?= $form ?>
 
    <input type="submit" value="Ajouter" />
  </p>
</form>