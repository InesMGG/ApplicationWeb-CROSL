DELETE FROM TRESORIER;
Insert Into Tresorier Values(1,'Valérie LAHEURTE','10 avenue de Clichy',60000, 'Beauvais');
Insert Into Tresorier Values(2,'Pierre LENOIR','9 rue Racine',76000, 'Rouen');
Insert Into Tresorier Values(3,'Mohamed BOURGARD','5 Avenue des Hérons',95800, 'Cergy');
SELECT * FROM TRESORIER;

DELETE FROM LIGUE;
Insert Into Ligue Values(411007,'Ligue Lorraine Escrime',1,'oui');
Insert Into Ligue Values(411008,'Ligue Lorraine de FootBall',2,'oui');
Insert Into Ligue Values(411009,'Ligue Lorraine de Basket',3,'non');
SELECT * FROM LIGUE;

DELETE FROM PRESTATION;
Insert Into Prestation Values('AFFRAN','Affranchissement',3.330);
Insert Into Prestation Values('PHOTOCOULEUR','Photocopies couleur',0.240);
Insert Into Prestation Values('PHOTON&B','Photocopies Noir et Blanc',0.055);
SELECT * FROM PRESTATION;

DELETE FROM FACTURE;
Insert Into Facture Values(5174,'2012-12-02','2012-02-29',411007);
SELECT * FROM FACTURE;

DELETE FROM LIGUE_FACTURE;
Insert Into Ligue_Facture Values(5174,'AFFRAN',1.00);
Insert Into Ligue_Facture Values(5174,'PHOTOCOULEUR',166.00);
Insert Into Ligue_Facture Values(5174,'PHOTON&B',899.00);
SELECT * FROM LIGUE_FACTURE;
