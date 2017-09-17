<div class="col-md-12">
	<div>
		Voici le footer du blog
	</div>
	<button id="identif">S'identifier</button>
	<div id="divFormIndex">
		<a href="/admin/">Connexion</a>
		<form id="formIndex" action="index.php?page=users" method="POST">
         	<p><label>Pseudo : 
            <input type="text" name="pseudo" value="<?php 
                    if(isset($_SESSION["pseudo"])){
                        echo htmlspecialchars($_SESSION['pseudo']);
                    }?>"> </label></p>
            <p><label>Mot de passe : 
            <input type="password" name="passe" value="<?php 
	                if(isset($_SESSION["passe"])){
	                    echo htmlspecialchars($_SESSION['passe']);
	                }?>"> </label></p>
            <p><input type="submit" name="submit"></p>
		</form>
	</div>			
</div>