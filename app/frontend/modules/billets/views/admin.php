<?php

session_start();

?>
<!DOCTYPE html>
<html>
	<head>
		<?php
		include_once("layout/head.php");
		?>
	<script type="text/javascript" src="view/js/tiny_mce/tiny_mce.js"></script>
    	<script type="text/javascript">

			tinyMCE.init({
				// type de mode
				mode : "exact", 
				// id ou class, des textareas
				elements : "titre,texte", 
				// en mode avancé, cela permet de choisir les plugins
				theme : "advanced", 
				// liste des plugins
				plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

				// les outils à afficher
				theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
				theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
				theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
				theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
				
				// emplacement de la toolbar
				theme_advanced_toolbar_location : "top",  
				// alignement de la toolbar
				theme_advanced_toolbar_align : "left",
				// positionnement de la barre de statut
				theme_advanced_statusbar_location : "bottom", 
				// permet de redimensionner la zone de texte
				theme_advanced_resizing : true,
				
				// chemin vers le fichier css
				//content_css : " ../styleAdmin.css,", 
				// taille disponible
				theme_advanced_font_sizes: "10px,11px,12px,13px,14px,15px,16px,17px,18px,19px,20px,21px,22px,23px,24px,25px", 
				// couleur disponible dans la palette de couleur
				theme_advanced_text_colors : "33FFFF, 007fff, ff7f00", 
				// balise html disponible
				theme_advanced_blockformats : "h1, h2,h3,h4,h5,h6",
				// class disponible
				theme_advanced_styles : "Tableau=textTab;TableauSansCadre=textTabSansCadre;", 
				// possibilité de définir les class et leurs styles directement avec le code suivant
				/*
				style_formats : [
					{title : 'Bold text', inline : 'b'},
					{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
					{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
					{title : 'Example 1', inline : 'span', classes : 'example1'},
					{title : 'Example 2', inline : 'span', classes : 'example2'},
					{title : 'Table styles'},
					{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
				],
				*/
			});
		</script>
	</head>
	<body>
			<header class="col-md-12">
				<?php
				include("layout/header.php");
				?>
				<div>
					<h3>Administration du blog</h3>
				</div>
					<div id="visiteAdmin">
						<a href="index.php?page=accueil">Visiter le Blog</a>
						<button id="accesDonneesAdmin">Mes données d'administration</button>
						<div id="divFormDonneesAdmin">
							<h5>Entrez un nouveau pseudo et un nouveau mot de passe</h5>
							<form id="formModifDonneesAdmin" action="admin.php" method="POST">
					         	<p><label>Pseudo : 
					            <input type="text" name="pseudo"> </label></p>
					            <p><label>Mot de passe : 
					            <input type="password" name="password"> </label></p>
					            <p><input type="submit" name="submit"></p>
			        		</form>
						</div>		
					</div>
			</header>
			<div id="principaleAdmin">
				<aside id="menuLeftAdmin" class="col-md-2">
					<span>Menu d'administration</span>
					<button id="creerBilletAdmin" class="butMenuLeftAdmin">Créer un nouveau billet</button>
					<a id="modifBilletAdmin" class="butMenuLeftAdmin" href="index.php?page=adminlect">Modifier un billet</button>
					<button id="modererComAdmin" class="butMenuLeftAdmin">Modérer les commentaires</button>
					<button id="modifIntroAdmin" class="butMenuLeftAdmin">Modifier le texte d'introduction</button>
					<button id="modifDescAuteur" class="butMenuLeftAdmin">Modifier la description de l'auteur</button>
				</aside>
				<section class="col-md-10">
					<?php
					include_once(VIEW.DS."post/zonesAdmin.php");
					
					
					?>
				
				<div id="zoneModifBillet"></div>
				<div id="zoneModererCom"></div>
				<div id="zoneModifIntro"></div>
				<div id="zoneModifDescAuteur"></div>
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
