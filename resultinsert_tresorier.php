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
        <?php
            if(isset($_POST["submit"]))
            {
            require_once('ConnectFC.php');
            $dbh = doConnect();
            $nomtre=$_POST['nomtreso_saisi'];
            $add = $_POST['adresse_saisi'];
            $cp = $_POST['cp_saisi'];
            $ville = $_POST['ville_saisi'];
            $sql = "SELECT count(*) as vtreso FROM tresorier WHERE Nomtreso = '$nomtre'";
            $sth = $dbh -> query($sql);
            $result = $sth -> fetch();
            $verification = $result['vtreso'];
            if ($verification == 0) 
            {
            $sql = "SELECT Numtreso FROM tresorier ORDER BY Numtreso DESC LIMIT 1";
            $sth = $dbh -> query($sql);
            $result = $sth -> fetch();
            $numtre = ($result['Numtreso'])+1;
            // $sql = "SELECT Numtreso FROM ligue ORDER BY Numtreso DESC LIMIT 1";
            // $sth = $dbh -> query($sql);
            // $result = $sth -> fetch();
            // $numtre = ($result['Numtreso'])+1;
            // $sql ="INSERT INTO ligue (Numcompte, Intitule, Numtreso, Envoitreso) VALUES ('$numcpt', '$inti', '$numtre', '$envoitre')";
            // echo $sql;
            // $dbh->exec($sql);
            $sql ="INSERT INTO tresorier (Numtreso, Nomtreso, Adresse, CP, Ville) VALUES ('$numtre', '$nomtre', '$add', '$cp', '$ville')";
            $dbh->exec($sql);
            $sql ="SELECT * FROM tresorier";
            $sth = $dbh->query($sql);
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            echo '<h3 align="center">Le trésorier '.$numtre.' a bien été ajouté !</h3>';
            echo '<table border="1px;" align="center">';
            echo '<thead>';
                echo '<tr>';
                    echo '<td align="center">Numéro de trésorier</td>';
                    echo '<td align="center">Nom de trésorier</td>';
                    echo '<td align="center">Adresse</td>';
                    echo '<td align="center">Code postale</td>';
                    echo '<td align="center">Ville</td>';
                echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            foreach ($result as $row) {
                echo '<tr>';
                echo '<td align="center">'.$row['Numtreso'].'</td>';
                echo '<td align="center">'.$row['Nomtreso'].'</td>';
                echo '<td align="center">'.$row['Adresse'].'</td>';
                echo '<td align="center">'.$row['CP'].'</td>';
                echo '<td align="center">'.$row['Ville'].'</td>';  
                echo '</tr>';
            }
            $dbh = NULL;
            echo '</tbody>';    
            echo '</table>';  
            }
            elseif ($verification > 0) 
            {
               echo '<h3 align="center">Le trésorier '.$nomtre.' existe déja !</h3>';

            }  
        }
        ?>
        <p align="center"><a style="color:red;" href="forminsert_ligue.php">Ajouter une ligue</a></p>
    </body>
    <footer class="Bas">
            <p>
                BTS SIO1<br>
                Melvin REDUREAU<br>
                Mai Thi TRAN DIEP<br>
                Inès MAGANGA<br>
            </p>
        </footer>
</html>