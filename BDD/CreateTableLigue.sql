DROP DATABASE IF EXISTS mdl2;
CREATE DATABASE mdl2;
USE mdl2;

drop table if exists TRESORIER;
drop table if exists LIGUE;
drop table if exists PRESTATION;
drop table if exists FACTURE;
drop table if exists LIGUE_FACTURE;

Create Table TRESORIER
	(
	Numtreso INT(2),
	Nomtreso VARCHAR(20),
	Adresse	VARCHAR(30),
	CP INT(5),
	Ville VARCHAR(20),
	CONSTRAINT PK_TRES PRIMARY KEY (numtreso)
	)Engine=Innodb;

Create Table LIGUE
	(
	Numcompte INT(6),
	Intitule VARCHAR(50),
	Numtreso INT(3),
	Envoitreso VARCHAR(3),
	CONSTRAINT PK_LIG PRIMARY KEY (numcompte)
	)Engine=Innodb;

Create Table PRESTATION
	(
	Code VARCHAR(20),
	Libelle VARCHAR(50),
	Pu FLOAT(4,3),
	CONSTRAINT PK_PRES PRIMARY KEY (code)
	)Engine=Innodb;

Create Table FACTURE
	(
	Numfacture VARCHAR(6),
	Datefact DATE,
	Echeance DATE,
	Compte_ligue INT(6),
	CONSTRAINT PK_FACT PRIMARY KEY (numfacture)
	)Engine=Innodb;

Create Table LIGUE_FACTURE
	(
	Numfacture VARCHAR(6),
	Code_pres VARCHAR(20),
	Quantite FLOAT(5,2),
	CONSTRAINT PK_LIGFACT PRIMARY KEY (numfacture, code_pres)
	)Engine=Innodb;
