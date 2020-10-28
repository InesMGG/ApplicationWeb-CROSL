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
    	<h1>Création de votre facture</h1>
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
        require_once('ConnectFC.php');
        $dbh = doConnect();
        ?>
        <form method="post" action="Création.php">
        <h3 align="center">Entrez votre ligue et la date</h3>
        <fieldset>
            <legend>Entrez la ligue</legend>
                <select name="NomLi" id="NomLi">
                <?php 
                $sql = "SELECT * FROM ligue";
                $sth = $dbh->query($sql);
                while ($donnees=$sth->fetch()) 
                {
                ?>
                    <option value="<?php echo $donnees['Numtreso']; ?>"> <?php echo $donnees['Intitule']; ?></option> 
                <?php  
                }
                ?>  
                </select>
        </fieldset>
        <fieldset>
            <legend>Entrez la date</legend>
            <input type="date" name="dateFC">
        </fieldset>
        <button name='Insert' type='submit' value='Valider'>Ajouter les prestations</button>
        </form>
        
        <?php
            if (!empty($_POST['Insert'])) 
            {
                echo "<br>";
                echo '<h3 align="center">Entrez vos prestations</h3>';
                $numT = $_POST['NomLi'];
                $d = $_POST['dateFC'];
                $dbh = doConnect();
                $sql = "SELECT Numfacture FROM facture ORDER BY Numfacture DESC LIMIT 1";
                $sth = $dbh -> query($sql);
                $result = $sth->fetch();
                $numF = ($result['Numfacture'])+1;
                $sql = "SELECT Numcompte FROM ligue WHERE Numtreso=$numT";
                $sth = $dbh -> query($sql);
                $result = $sth->fetch();
                $numC = ($result['Numcompte']);
                $sql = "INSERT INTO facture (Numfacture,Datefact,Echeance,Compte_ligue) VALUES ($numF,'$d',NULL,$numC)";
                $dbh->exec($sql);
                $sql = "SELECT LAST_DAY ('$d') AS Echeance FROM facture WHERE Numfacture = $numF";
                $sth = $dbh -> query($sql);
                $result = $sth->fetch();
                $eche= ($result['Echeance']);
                $sql = "UPDATE facture  SET Echeance = '$eche' WHERE Numfacture = $numF";
                $dbh->exec($sql);
                echo "<form align='left' method='post' action='Création.php'>";
                echo '<input required type="hidden" name="NomFC" value="'.$numF.'">';
                echo "<fieldset>";
                echo "<legend>Nouvelle prestation</legend>";
                echo "<select name='pre1'>";
                $sql = "SELECT * FROM Prestation";
                $sth = $dbh->query($sql);
                while ($donnees=$sth->fetch()) 
                {
                ?>
                    <option value="<?php echo $donnees['Code']; ?>"> <?php echo $donnees['Libelle']; ?></option> 
                <?php  
                } 
                echo "</select>";
                echo "<input type='number' name='p1' placeholder='Quantité' step='0.00'>";
                echo "</fieldset>";
                echo "<button name='Val' type='submit' value='Valider'>Valider la prestation</button>";
                echo "</form>"; 
            }
        ?>
        <?php
        if (!empty($_POST['Val'])) 
        {
            $Numfac= $_POST['NomFC'];
            $novpres = $_POST['pre1'];
            $Novpu = $_POST['p1'];
            $dbh = doConnect();
            $sql = "INSERT INTO ligue_facture(Numfacture,Code_pres,Quantite) VALUES ($Numfac,'$novpres','$Novpu')";
            $dbh->exec($sql);
            echo '<h3 align="center">Entrez vos prestations</h3>';
            echo "<form align='left' method='post' action='Création.php'>";
            echo '<input required type="hidden" name="NomFC" value="'.$Numfac.'">';
            echo "<fieldset>";
            echo "<legend>Nouvelle prestation</legend>";
            echo "<select name='pre1'>";
            $sql = "SELECT * FROM Prestation";
            $sth = $dbh->query($sql);
            while ($donnees=$sth->fetch()) 
            {
            ?>
                <option value="<?php echo $donnees['Code']; ?>"> <?php echo $donnees['Libelle']; ?></option> 
            <?php  
            } 
            echo "</select>";
            echo "<input type='number' name='p1' placeholder='Quantité' step='0.00'>";
            echo "</fieldset>";
            echo "<button name='Val' type='submit' value='Valider'>Valider la prestation</button>";
            echo "</form>"; 
            echo "<br>";
            echo "<form align='left' method='post' action='traitementFC2.php'>";
            echo '<input required type="hidden" name="NomFC" value="'.$Numfac.'">';
            echo "<input type='submit' name='ILF' value='Voir la facture'>";
            echo "</form>";
            echo '<h3 align="center">Votre prestation a été saisie</h3>';
            echo "<table border='1px' align='center'>";
                echo "<thead>";        
                    echo "<tr>";            
                        echo "<td align='center'>Numéro de facture</td>";                
                        echo "<td align='center'>Code de la prestation</td>";                
                        echo "<td align='center'>Quantité</td>";                                
                    echo "</tr>";            
                echo "</thead>";        
                echo "<tbody>";
                $sql = "SELECT * FROM ligue_facture WHERE Numfacture = '$Numfac'";
                $sth = $dbh-> query($sql);
                $result = $sth->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) 
                {
                    echo '<tr>';
                    echo '<td>'.$row['Numfacture'].'</td>';
                    echo '<td>'.$row['Code_pres'].'</td>';
                    echo '<td>'.$row['Quantite'].'</td>'; 
                    echo '</tr>';
                }
                $dbh = NULL;
                echo "</tbody>";
                echo "</table>";  
        }
        ?>
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