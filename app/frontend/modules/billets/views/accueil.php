<?php


foreach ($listeBillets as $billets)
{
?>
  <h2><a href="billets-<?= $billets['id'] ?>.html"><?= $billets['titre'] ?></a></h2>
  <p><?= nl2br($billets['contenu']) ?></p>
<?php
}
