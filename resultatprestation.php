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
        <h1>Création d'une prestation</h1>
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
        <?php
            if (!empty($_POST['Code'])) 
            {
                require_once('ConnectFC.php');
                $dbh = doConnect();
                $code=$_POST ['Code'];
                $Libelle=$_POST ['Libelle'];
                $PrixU=$_POST ['PrixU'];
                $sql = "SELECT count(*) as vpresta FROM Prestation WHERE Code = '$code'";
                $sth = $dbh -> query($sql);
                $result = $sth -> fetch();
                $verification = $result['vpresta'];
                if ($verification == 0) 
                {
                $sql = "INSERT INTO prestation (Code, Libelle, Pu) VALUES ('$code', '$Libelle', $PrixU)";
                $dbh->exec($sql);
                echo '<h3 align="center">La prestation '.$code.' a bien été ajouté !</h3>';
                    echo "<table border = 1px align='center'>";
                        echo "<thead>";
                            echo "<tr>";
                                echo "<td>Code de la prestation</td>";
                                echo "<td>Nom de la prestation</td>";
                                echo "<td>Prix de la prestation</td>";
                            echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                $sql = "SELECT * FROM prestation";
                $sth = $dbh-> query($sql);
                $result = $sth->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) 
                {
                            echo '<tr>';
                                echo '<td align="center">'.$row['Code'].'</td>';
                                echo '<td align="center">'.$row['Libelle'].'</td>';
                                echo '<td align="center">'.$row['Pu'].'</td>';
                                echo '</tr>';
                }
                $dbh = NULL;
                        echo "</tbody>";
                echo "</table>";
                }
                elseif ($verification > 0) 
                {
                  echo '<h3 align="center">La prestation '.$code.' existe déja !</h3>';
                }
            }
        ?>
        <p align="center"><a style="color:red;" href="formprestation.html">Ajouter une prestation</a></p>
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