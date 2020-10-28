<head>
		<meta charset="utf-8"/>
		<title>Facture</title>
    <link rel="stylesheet" href="css/style1.css">
    <style>
      .yesPrint, .noPrint {display:block;}
      @media print {
      .noPrint {display:none;}
    }
    </style>
</head>
<body>
  <?php
    require_once('FonctionFC.php');
    $numfac = $_POST['NomFC'];
    
  ?>
  <div class="yesPrint">
    <p>
      <strong>CROSL</strong><br>
      Maison Régionale des Sports de Lorraine <br>
      13 rue Jean Moulin <br>
      BP 70001<br>
     <strong>54510 TOMBLAINE</strong>  <br>
      Siret 31740105700029<br>
      Tel <strong>03.83.18.87.02</strong><br>
      Fax 03.83.18.87.02<br>
    </p>
    <p align="right">
      <?php NomLig2($numfac);?><br>
      <?php NomTre2($numfac);?><br>
      <?php AdTres2($numfac);?><br>
  </p>
  <p>
  <strong>Facture</strong><br> 
  </p>
    <p align="left">
      <?php DNCE2($numfac)?><br>
    </p>
    <p>
      <?php pres21($numfac)?><br>
    </p>
    <p>
      Déclaré à la préfecture de Meurthe et Moselle N°3898<br>
      Domiciliation bancaire 10278 04065 000 166911045 05<br>
      Merci de bien vouloir préciser les références de la facture acquittée<br>
      TVA non applicable<br>
    </p>
  </div>
  <div class="noPrint">
    <input type="button" onclick="window.print();" value="Imprimer la facture" />
    <a href="Archive.php" style="text-decoration: underline;">Retour</a>
  </div>
  
</body>
