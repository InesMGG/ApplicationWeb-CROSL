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
        <h1>Modification d'une facture</h1>
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
            echo "<form align='center' method='post'>";
            echo "<label>Sélectionner une facture</label><br>";    
            echo "<select name='formMod' onchange='this.form.submit()''>";
            require_once('ConnectFC.php');
            $dbh = doConnect();
            $sql = "SELECT DISTINCT Numfacture FROM ligue_facture ";
            $sth = $dbh -> query($sql);
            while($donnees=$sth->fetch())
                {
                ?>
                    <option value="<?php echo $donnees['Numfacture']; ?>"><?php echo $donnees['Numfacture'];?></option>
                <?php   
                }
            echo "</select>";
            echo "</form>";
            echo "<br>";
        ?>
        <?php  
            if(isset($_POST['formMod']))
            {
                require_once('FonctionFC.php');
                $res = $_POST['formMod'];
                AfficheFacture($res);
                echo "<br>";
                echo "<form align='center' method='post' action='Modifier.php'>";
                echo '<input required type="hidden" name="nfac" value="'.$res.'">';
                echo "<button name='Insert' type='submit' value='Valider'>Ajouter une prestation</button>";
                echo " ";
                echo "<button name='Modifier' type='submit' value='Valider'>Modifier une prestation</button>";
                echo " ";
                echo "<button name='Supprimer' type='submit' value='Valider'>Supprimer une prestation</button>";
                echo "</form>";
            }
        ?>
        <?php  
            if (!empty($_POST['Insert'])) 
            {
                require_once('FonctionFC.php');
                $res = $_POST['nfac']; 
                AfficheFacture($res);
                require_once('ConnectFC.php');   
                $dbh = doConnect();
                echo "<br>";
                echo "<form align='left' method='post' action='Modifier.php'>";
                echo '<input required type="hidden" name="nfac" value="'.$res.'">';
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
                echo "<button name='Modif' type='submit' value='Valider'>Valider les modifications</button>";
                echo "</form>";
            }
        ?>
        <?php
            if (!empty($_POST['Modif'])) 
            {
                require_once('ConnectFC.php');
                $Numfac= $_POST['nfac'];
                $novpres = $_POST['pre1'];
                $Novpu = $_POST['p1'];
                $dbh = doConnect();
                $sql = "INSERT INTO ligue_facture(Numfacture,Code_pres,Quantite) VALUES ($Numfac,'$novpres','$Novpu')";
                $dbh->exec($sql);
                echo '<h3 align="center">Votre demande a été effectuée</h3>';
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
        <?php  
            if (!empty($_POST['Modifier'])) 
            {
                require_once('FonctionFC.php');
                $res = $_POST['nfac']; 
                AfficheFacture($res);
                require_once('ConnectFC.php');   
                $dbh = doConnect();
                echo "<br>";
                echo "<form align='left' method='post' action='Modifier.php'>";
                echo '<input required type="hidden" name="nfac" value="'.$res.'">';
                echo "<fieldset>";
                echo "<legend>Code de la prestation</legend>";
                echo "<select name='pre1'>";
                $sql = "SELECT * FROM Prestation";
                $sth = $dbh->query($sql);
                while ($donnees=$sth->fetch()) 
                {
                ?>
                    <option value="<?php echo $donnees['Code']; ?>"> <?php echo $donnees['Code']; ?></option> 
                <?php  
                } 
                echo "</select>";
                echo "<input type='number' name='p1' placeholder='Nouvelle Quantité' step='0.00'>";
                echo "</fieldset>";
                echo "<button name='Modifi' type='submit' value='Valider'>Valider les modifications</button>";
                echo "</form>";
            }
        ?>
        <?php
            if (!empty($_POST['Modifi'])) 
            {
                require_once('ConnectFC.php');
                $Numfac= $_POST['nfac'];
                $novpres = $_POST['pre1'];
                $Novpu = $_POST['p1'];
                $dbh = doConnect();
                $sql = "UPDATE ligue_facture SET Quantite = $Novpu WHERE Numfacture = $Numfac and Code_pres = '$novpres'";
                $dbh->exec($sql);
                echo '<h3 align="center">Votre demande a été effectuée</h3>';
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
        <?php  
            if (!empty($_POST['Supprimer'])) 
            {
                require_once('FonctionFC.php');
                $res = $_POST['nfac']; 
                AfficheFacture($res);
                require_once('ConnectFC.php');   
                $dbh = doConnect();
                echo "<br>";
                echo "<form align='left' method='post' action='Modifier.php'>";
                echo '<input required type="hidden" name="nfac" value="'.$res.'">';
                echo "<fieldset>";
                echo "<legend>Code de la  prestation à supprimer</legend>";
                echo "<select name='pre1'>";
                $sql = "SELECT * FROM Prestation";
                $sth = $dbh->query($sql);
                while ($donnees=$sth->fetch()) 
                {
                ?>
                    <option value="<?php echo $donnees['Code']; ?>"> <?php echo $donnees['Code']; ?></option> 
                <?php  
                } 
                echo "</select>";
                echo "</fieldset>";
                echo "<button name='Modifie' type='submit' value='Valider'>Valider les modifications</button>";
                echo "</form>";
            }
        ?>
        <?php
            if (!empty($_POST['Modifie'])) 
            {
                require_once('ConnectFC.php');
                $Numfac= $_POST['nfac'];
                $novpres = $_POST['pre1'];
                $dbh = doConnect();
                $sql = "DELETE FROM ligue_facture WHERE Numfacture = $Numfac and Code_pres = '$novpres'";
                $dbh->exec($sql);
                echo '<h3 align="center">Votre demande a été effectuée</h3>';
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