<!DOCTYPE html>
<html>
       <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style1.css">
        <link rel="stylesheet" href="css/style.css">
        <title>CROSL, application web</title>
    </head>
    <body>
        <header class="Haut">
            <img src="Maison des Ligues.png" alt="Logo du site" id="Logo" height="150" width="200"/>
        </header>
        <h1>Création d'une ligue</h1>
        <div class="navbar">
            <a href="Accueil.html">Accueil</a>
            <div class="dropdown">
                <button class="dropbtn">Ligue</button>
                <div class="dropdown-content">
                  <a href="forminsert_ligue.php">Ajouter</a>  
                  <a href="choix_ligue.php">Modifier / Supprimer</a>  
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">Prestation</button>
                <div class="dropdown-content">
                  <a href="formprestation.html">Ajouter</a>  
                  <a href="choix_prestation.php">Modifier / Supprimer</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">Trésorier</button>
                <div class="dropdown-content">
                  <a href="forminsert_tresorier.php">Ajouter</a>  
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">Factures</button>
                <div class="dropdown-content">
                  <a href="Création.php">Création</a>
                  <a href="Modifier.php">Modifier</a>  
                  <a href="Archive.php">Archives</a>
                </div>
            </div>
        </div>
        <br>
	<body>
		<?php
		require_once('ConnectFC.php');
		$dbh = doConnect();
		$sql = "SELECT numtreso, nomtreso FROM tresorier";
		$sth = $dbh->query($sql);
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		$dbh = null;
		?>
		<h3 align="center">Entrer pour ajouter une Ligue</h3>
		</br>
		<form id="new_ligue" name="new_ligue" align="center" method="post" action="resultinsert_ligue.php">
			<p>
				Intitulé :
				<br/>
				<input type="text" name="intitule_saisi" id="intitule_saisi"required />
			</p>
			</br>
			<p>
				<label for="treso_choix">Choisir un trésorier :</label>
				<select id="treso_choix" name="treso_choix">
				<?php
				foreach ($result as $row) {
					echo '<option'.(($numtre == $row['numtreso'] ) ? ' selected ' : ' ').'value="'.$row['numtreso'].'">'.$row['nomtreso'].'</option>';
				}
				?>
				</select>
			</p>
			</br>
			<p>
				<label for="envoitreso_choix">Envoyer à trésorier ?</label>
				<select id="envoitreso_choix" name="envoitreso_choix">
				<option value="oui">Oui</option>
				<option value="non">Non</option>
				</select>
			</p>
			</br>
			<input type="submit" value="Valider"/>
			<input type="reset" value="Réinitialiser"/>
		</form>
		<footer class="Bas">
    		<p>
                BTS SIO1<br>
    			Melvin REDUREAU<br>
    			Mai Thi TRAN DIEP<br>
    			Inès MAGANGA<br>
    		</p>
    	</footer>
	</body>
</html>


