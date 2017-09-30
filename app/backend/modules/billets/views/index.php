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
<div id="listeCommentairesSignales">
	<h2>Liste des commentaires signalés</h2>
	<table>
  <tr><th>pseudo</th><th>Titre</th><th>Contenu</th><th>Date d'ajout</th><th>Action</th></tr>

	<?php foreach ($listeCommentairesSignales as $comment){
		echo 	'<tr><td>', $comment['pseudo'], 
				'</td><td>', $comment['titre'], 
				'</td><td>le ', $comment['contenu'], 
				'</td><td>', ($comment['dateAjout']->format('d/m/Y à H\hi')), 
				'</td><td><a href=/admin/comment-update-',$comment["id"].'.html><img src="/images/update.png" alt="Modifier" /></a> 
				<a href=/admin/comment-delete-', $comment['id'].'.html><img src="/images/delete.png" alt="Supprimer" /></a></td></tr>', "\n";
	} ?>
</div>