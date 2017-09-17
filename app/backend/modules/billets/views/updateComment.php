<form action="" method="post">
  <p>
    <?= isset($erreurs) && in_array(\entity\Comment::AUTEUR_INVALIDE, $erreurs) ? 'L\'auteur est invalide.<br />' : '' ?>
    <label>Pseudo</label><input type="text" name="pseudo" value="<?= htmlspecialchars($comment['auteur']) ?>" /><br />
 
    <?= isset($erreurs) && in_array(\entity\Comment::CONTENU_INVALIDE, $erreurs)) ? 'Le texte est invalide.<br />' : '' ?>
    <label>Texte</label><textarea name="texte" rows="7" cols="50"><?= htmlspecialchars($comment['texte']) ?></textarea><br />
 
    <input type="hidden" name="billets" value="<?= $comment['billets'] ?>" />
    <input type="submit" value="Modifier" />
  </p>
</form>