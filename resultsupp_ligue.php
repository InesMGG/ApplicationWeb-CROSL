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
        <h1>Suppression d'une ligue</h1>
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
        <br/>
        <?php
            require_once('ConnectFC.php');
            $dbh = doConnect();
            $numcpt= $_GET['numcompte'];
            $sql = "DELETE FROM ligue WHERE numcompte=$numcpt";
            try {
                $re = $dbh->exec($sql);
            } catch(PDOException $e) {
                print("Erreur ! $e.\n");
            }
            $dbh->exec($sql);
            $sql ="SELECT * FROM ligue";
            $sth = $dbh->query($sql);
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            echo '<h3 align="center">La ligue '.$numcpt.' a bien été supprimé !</h3>';
            echo '<table border="1px;" align="center">';
            echo '<thead>';
                echo '<tr>';
                    echo '<td align="center">Numéro de compte</td>';
                    echo '<td align="center">Intitulé</td>';
                    echo '<td align="center">Numéro de trésorier</td>';
                    echo '<td align="center">Envoyer trésorier</td>';
                echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            foreach ($result as $row) {
                echo '<tr>';
                echo '<td align="center">'.$row['Numcompte'].'</td>';
                echo '<td align="center">'.$row['Intitule'].'</td>';
                echo '<td align="center">'.$row['Numtreso'].'</td>';
                echo '<td align="center">'.$row['Envoitreso'].'</td>';  
                echo '</tr>';
            }
            $dbh = NULL;
            echo '</tbody>';    
            echo '</table>';
        ?>
        <p align="center">
            <button onclick="location.href='Accueil.html'">Retourner à l'acceuil</button>
        </p>
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