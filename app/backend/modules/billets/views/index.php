<p style="text-align: center">Il y a actuellement <?= $nombreBillets ?> billets. En voici la liste :</p>
 
<table>
  <tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
<?php
foreach ($listeBillets as $billets)
{
  echo '<tr><td>', $billets['auteur'], '</td><td>', $billets['titre'], '</td><td>le ', $billets['dateAjout']->format('d/m/Y à H\hi'), '</td><td>', ($billets['dateAjout'] == $billets['dateModif'] ? '-' : 'le '.$billets['dateModif']->format('d/m/Y à H\hi')), '</td><td><a href="billets-update-', $billets['id'], '.html"><img src="/images/update.png" alt="Modifier" /></a> <a href="billets-delete-', $billets['id'], '.html"><img src="/images/delete.png" alt="Supprimer" /></a></td></tr>', "\n";
}
?>
</table>