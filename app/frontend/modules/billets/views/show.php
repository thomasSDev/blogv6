<p>Par <em><?= $billets['auteur'] ?></em>, le <?= $billets['dateAjout']->format('d/m/Y à H\hi') ?></p>
<h2><?= $billets['titre'] ?></h2>
<p><?= nl2br($billets['contenu']) ?></p>
 
<?php if ($billets['dateAjout'] != $billets['dateModif']) { ?>
  <p style="text-align: right;"><small><em>Modifiée le <?= $billets['dateModif']->format('d/m/Y à H\hi') ?></em></small></p>
<?php } ?>
 
<p><a href="commenter-<?= $billets['id'] ?>.html">Ajouter un commentaire</a></p>
 
<?php
if (empty($comments))
{
?>
<p>Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
<?php
}
 
foreach ($comments as $comment)
{
?>
  <fieldset>
    <legend>
      Posté par <strong><?= htmlspecialchars($comment['pseudo']) ?></strong> le <?= $comment['dateAjout']->format('d/m/Y à H\hi') ?>
    </legend>
    <p><?= nl2br(htmlspecialchars($comment['contenu'])) ?></p>
  </fieldset>
<?php
}
?>
 
<p><a href="commenter-<?= $billets['id'] ?>.html">Ajouter un commentaire</a></p>