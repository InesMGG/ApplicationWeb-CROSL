<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style1.css">
        <link rel="stylesheet" href="css/style.css">
        <title>CROSL</title>
    </head>
    <body>
    	<header class="Haut">
    		<img src="Maison des Ligues.png" alt="Logo du site" id="Logo" height="150" width="200"/>
    	</header>
    	<h1>Création d'un trésorier</h1>
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
	<body>
        <h3 align="center">Entrer pour ajouter un Tresorier</h3>
        </br>
        <form id="forminsert_tresorier" name="forminsert_tresorier" align="center" method="post" action="resultinsert_tresorier.php">
			<p>
				Nom de trésorier :
				<br/>
				<input type="text" name="nomtreso_saisi" id="nomtreso_saisi"required />
      </p>
      </br>
      <p>
				Adresse :
				<br/>
				<input type="text" name="adresse_saisi" id="adresse_saisi"required />
      </p>
      </br>
      <p>
				Code postale :
				<br/>
				<input type="text" name="cp_saisi" id="cp_saisi"required />
      </p>
      </br>
      <p>
				Ville :
				<br/>
				<input type="text" name="ville_saisi" id="ville_saisi"required />
      </p>
      </br>
      <input type="submit" value="Valider" name="submit" />
			<input type="reset" value="Réinitialiser" name="reset" />
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