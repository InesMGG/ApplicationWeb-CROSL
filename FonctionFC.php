<?php
require_once('ConnectFC.php');
function NomLig2($numfac) {
    $dbh = doConnect();
    $sql = "SELECT * FROM facture WHERE Numfacture=$numfac";
    $sth = $dbh-> query($sql);
    $result = $sth->fetch();
    $cl = $result['Compte_ligue'];
   	$sql = "SELECT * FROM ligue WHERE  Numcompte = $cl";
    $sth = $dbh-> query($sql);
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) 
    {
        echo '<td>'.$row['Intitule'].'</td>';
    }
    $dbh = NULL; 
}
function NomTre2($numfac) {
    $dbh = doConnect();
    $sql = "SELECT * FROM facture WHERE Numfacture=$numfac";
    $sth = $dbh-> query($sql);
    $result = $sth->fetch();
    $cl = $result['Compte_ligue'];
   	$sql = "SELECT * FROM ligue WHERE  Numcompte = $cl";
    $sth = $dbh-> query($sql);
    $result = $sth->fetch();
    $clo = $result['Numtreso'];
   	$sql = "SELECT * FROM tresorier WHERE Numtreso = $clo";
    $sth = $dbh-> query($sql);
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) 
    {
        echo '<td>'.$row['Nomtreso'].'</td>';
    }
    $dbh = NULL; 
}
function AdTres2($numfac){
    $dbh = doConnect();
    $sql = "SELECT * FROM facture WHERE Numfacture=$numfac";
    $sth = $dbh-> query($sql);
    $result = $sth->fetch();
    $cl = $result['Compte_ligue'];
    $sql = "SELECT * FROM ligue WHERE  Numcompte = $cl";
    $sth = $dbh-> query($sql);
    $result = $sth->fetch();
    $clo = $result['Envoitreso'];
    $ad = $result['Numtreso'];
    if ($clo == 'oui') 
    {
    $sql = "SELECT * FROM tresorier WHERE Numtreso = $ad";
    $sth = $dbh-> query($sql);
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) 
    {
        echo '<td>'.$row['Adresse'].'</td><br>';
        echo '<td><strong>'.$row['CP'].' </strong></td>';
        echo '<td><strong>'.$row['Ville'].'</strong></td>'; 
    }
    $dbh = NULL; 
    }
    elseif ($clo == 'non') {
        echo "Maison Régionale des Sports de Lorraine<br>";
        echo "13 rue Jean Moulin<br>";
        echo "<strong>54510 TOMBLAINE</strong><br>";
    }
}
function DNCE2($numfac){
	$dbh = doConnect();
    echo "<table>";
        echo "<thead>";
            echo "<tr>";
                echo "<td>Date</td>";
                echo "<td>Numéro</td>";
                echo "<td>Code Client</td>";
                echo "<td>Echéance</td>";
            echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
    $sql = "SELECT * FROM facture WHERE  Numfacture = $numfac";
    $sth = $dbh-> query($sql);
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) 
    {
    	echo '<tr>';
        echo '<td>'.$row['Datefact'].'</td>';
        echo '<td>FC'.$row['Numfacture'].'</td>';
        echo '<td>'.$row['Compte_ligue'].'</td>';
        echo '<td>'.$row['Echeance'].'</td>';
        echo '</tr>';
    }
    $dbh = NULL;
    echo "</tbody>";
    echo "</table>";
}
function pres21($numfac){
	$dbh = doConnect();
    echo "<table>";
        echo "<thead>";
            echo "<tr>";
                echo "<td>Référence</td>";
                echo "<td>Désignation</td>";
                echo "<td>Quantité</td>";
                echo "<td>PU HT</td>";
                echo "<td>Montant TTC</td>";
            echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
    $sql = "SELECT Numfacture, Code_pres, Quantite, sum(Quantite*Pu) AS MontantTotal FROM ligue_facture L, prestation p WHERE numfacture = $numfac AND L.Code_pres=P.Code";
    $sth = $dbh-> query($sql);
    $result = $sth->fetch();
    $to = $result['MontantTotal'];
    $sql = "SELECT Numfacture, Code_pres,Quantite,Pu,Libelle,sum(Quantite*Pu) AS MontantPu FROM ligue_facture L,Prestation P WHERE  Numfacture = $numfac AND L.Code_pres=P.Code GROUP BY Code_pres";
    $sth = $dbh-> query($sql);
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) 
    {
    	echo '<tr>';
        echo '<td>'.$row['Code_pres'].'</td>';
        echo '<td>'.$row['Libelle'].'</td>';
        echo '<td>'.$row['Quantite'].'</td>';
        echo '<td>'.$row['Pu'].'</td>';
        echo '<td>'.$row['MontantPu'].'</td>';  
        echo '</tr>';
    }
    $dbh = NULL;
    echo "</tbody>";
    echo "</table>";
    echo "<br>";
    echo "<p align='center'>Total TTC: $to</p>";
    echo "<p align='center'><strong>Montant à payer: $to</strong></p>";
}
function AfficheLigue($res)
{
    $dbh = doConnect();
    echo "<table border='1px' align='center'>";
        echo "<thead>";        
            echo "<tr>";            
                echo "<td align='center'>Numéro de compte</td>";                
                echo "<td align='center'>Intitulé</td>";                
                echo "<td align='center'>Numéro de trésorier</td>";                
                echo "<td align='center'>Envoyer à trésorier</td>";                
            echo "</tr>";            
        echo "</thead>";        
    echo "<tbody>";
    $sql = "SELECT * FROM Ligue WHERE Numcompte = $res";
    $sth = $dbh-> query($sql);
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) 
    {
        echo '<tr>';
        echo '<td>'.$row['Numcompte'].'</td>';
        echo '<td>'.$row['Intitule'].'</td>';
        echo '<td>'.$row['Numtreso'].'</td>';
        echo '<td>'.$row['Envoitreso'].'</td>'; 
        echo '</tr>';
    }
    $dbh = NULL;
    echo "</tbody>";
    echo "</table>";        
}
function AffichePrestation($res)
{
    $dbh = doConnect();
    echo "<table border='1px' align='center'>";
        echo "<thead>";        
            echo "<tr>";            
                echo "<td align='center'>Code</td>";                
                echo "<td align='center'>Libellé</td>";                
                echo "<td align='center'>Prix Unitaire</td>";                                
            echo "</tr>";            
        echo "</thead>";        
    echo "<tbody>";
    $sql = "SELECT * FROM Prestation WHERE Code = '$res'";
    $sth = $dbh-> query($sql);
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) 
    {
        echo '<tr>';
        echo '<td>'.$row['Code'].'</td>';
        echo '<td>'.$row['Libelle'].'</td>';
        echo '<td>'.$row['Pu'].'</td>'; 
        echo '</tr>';
    }
    $dbh = NULL;
    echo "</tbody>";
    echo "</table>";        
}
function AfficheFacture($res)
{
    $dbh = doConnect();
    echo "<table border='1px' align='center'>";
        echo "<thead>";        
            echo "<tr>";            
                echo "<td align='center'>Numéro de facture</td>";                
                echo "<td align='center'>Code de la prestation</td>";                
                echo "<td align='center'>Quantité</td>";                                
            echo "</tr>";            
        echo "</thead>";        
    echo "<tbody>";
    $sql = "SELECT * FROM ligue_facture WHERE Numfacture = $res";
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