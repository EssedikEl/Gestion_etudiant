drop database if exists gestion_etudiants;

create database if not exists gestion_etudiants;

use gestion_etudiants;

create table Etudiant(
    idEtudiant int(5) auto_increment primary key,
    nomEtudiant varchar(50),
    prenomEtudiant varchar(50),
    dateNaissanceEtudiant date,
    lieuNaissanceEtudiant varchar(25),
    addresse varchar(100),
    codeCivilite varchar(1),
    photo varchar(100),
    emailEtudiant varchar(255),
    telEtudiant varchar(10),
    codeParent int(5)
);

create table Pays(
    codePays int(3) primary key,
    nomPays varchar(30)
);

create table Niveau(
    idNiveau int(5) primary key,
    nomNiveau varchar(50)
);

create table Tarif(
    codePeriode int(3),
    idNiveau int(5),
    prix    decimal(12,3)

);

create table Periode(
    idPeriode int(3) auto_increment primary key,
    nomPeriod varchar(30)
);

create table EtudiantAnneeScolaire(
    idEtudiant int(5) ,
    idNiveau int(5) ,
    anneScolaire varchar(9) ,
    doublons Boolean
);

create table Matieres(
    IdMatiere int(5) auto_increment primary key,
    nomMatiere varchar(30)
);

create table Professeur(
    IdProf int(5) auto_increment primary key,
    nomProf varchar(50),
    prenomProf varchar(50),
    codeCivilite varchar(1),
    IdMatiere int(5)
);

create table Notes(
    idEtudiant int(5) ,
    IdMatiere int(5) ,
    anneeScolaire varchar(30) ,
    note int(2),
    valide Boolean
);

create table Parent(
    IdParent int(5) auto_increment primary key,
    nomPere varchar(50),
    prenomPere varchar(50),
    telPere varchar(10),
    emailPere varchar(255),
    nomMere varchar(50),
    prenomMere varchar(50),
    telMere varchar(10),
    emailMere varchar(255)
);

create table reglement(
    idReglement int(5) auto_increment primary key,
    dateReglement Date,
    montant decimal(12,3),
    anneeScolaire varchar(9) ,
    periodReglement int(1),
    idEtudiant int(5)
);

create table reglementParTranche(
  idEtudiant int(5) primary key,
  tranche1_O_N Boolean,
  tranche2_O_N Boolean,
  tranche3_O_N Boolean,
  tranche4_O_N Boolean,
  anneeScolaire varchar(9)
);

create table civilite(
    codeCivilite varchar(1) primary key,
    nomCivilite varchar(15)
);

create table utilisateurs(
    idUser int(5) auto_increment primary key,
    login varchar(50),
    email varchar(255),
    role varchar(50),
    etat int(1),
    pwd varchar(255)
);

create table demandeAdmission(
  idDemande int(5) auto_increment primary key,
  idUser int(5),
  typeDemandeur varchar(1),
  fullName varchar(100),
  phone varchar(13),
  ville varchar(50),
  ecole varchar(255),
  filiere varchar(2),
  typefinancement int(1),
  mail varchar(255),
  niveau int(1),
  etat varchar(1)
);

alter table demandeAdmission
add constraint foreign key(idUser) references utilisateurs(idUser);

alter table reglement
add constraint foreign key(idEtudiant) references Etudiant(idEtudiant);

Alter table Notes
Add constraint primary key(idEtudiant,IdMatiere,anneeScolaire),
add constraint foreign key(idEtudiant) references Etudiant(idEtudiant),
add constraint foreign key(IdMatiere)  references Matieres(IdMatiere);

Alter table Professeur
Add constraint foreign key(codeCivilite) references civilite(codeCivilite),
Add constraint foreign key(IdMatiere) references Matieres(IdMatiere);

Alter table EtudiantAnneeScolaire
Add constraint primary key(idEtudiant,idNiveau,anneScolaire),
Add constraint foreign key(idEtudiant) references Etudiant(idEtudiant),
Add constraint foreign key(idNiveau) references Niveau(idNiveau);

Alter table Tarif
Add constraint primary key(codePeriode,idNiveau),
Add constraint foreign key(codePeriode) references Periode(idPeriode),
Add constraint foreign key(idNiveau) references Niveau(idNiveau);

Alter table Etudiant
Add constraint foreign key(codeCivilite) references civilite(codeCivilite),
Add constraint foreign key(codeParent) references Parent(IdParent);

Alter table reglementParTranche
Add constraint foreign key (idEtudiant) references Etudiant(idEtudiant);

Insert into Pays values
(504,'Maroc');
Insert into Pays values
(250,'France');


Insert into Matieres (nomMatiere)
values ('Gestion de Projets');
Insert into Matieres (nomMatiere)
values ('Probabilite');
Insert into Matieres (nomMatiere)
values ('Informatique');
Insert into Matieres (nomMatiere)
values ('Mathematique');
Insert into Matieres (nomMatiere)
values ('Anglais');
Insert into Matieres (nomMatiere)
values ('Physique');
Insert into Matieres (nomMatiere)
values ('Comptabilite');


Insert into civilite values
('M','Masculin');
Insert into civilite values
('F','Feminin');

Insert into Niveau (idNiveau,nomNiveau)
values (1,'1er annee');
Insert into Niveau (idNiveau,nomNiveau)
values (2,'2eme annee');
Insert into Niveau (idNiveau,nomNiveau)
values (3,'3eme annee');

Insert into Professeur (nomProf, prenomProf, codeCivilite, IdMatiere)
Values ('Samir', 'Youness', 'M', 4);
Insert into Professeur (nomProf, prenomProf, codeCivilite, IdMatiere)
Values ('Atik', 'Hanane', 'F', 5);

Insert into utilisateurs(login, email,role,etat,pwd)
values ('admin','elabdellaoui.hajar@gmail.com','ADMIN',1,md5('1234')),
('user1','user1@gmail.com','VISITEUR',0,md5('1234')),
('user2','user2@gmail.com','VISITEUR',1,md5('1234'));

Insert into Parent (nomPere,prenomPere,telPere,emailPere,nomMere,prenomMere,telMere,emailMere) values
('EL ABDELLAOUI','HASSANE','0648987644','elabdellaoui.hassane@gmail.com','EL HILLALI','BATOULE','0606987644','elhillali.batoule@gmail.com') ,
('MARWA','YOUSSEF','0648777644','marwa.youssef@gmail.com','BICHARI','YAKOUT','0647797644','bichari.yakout@gmail.com') ,
('EL MAHDAOUI','MOHAMED','0668987644','elmahdaoui.mohamed@gmail.com','EL CHORFI','IHSSANE','0666987660','elchorfi.ihssane@gmail.com'),
('EL FQUIH','JALAL','0678687544','elfquih.jalal@gmail.com','EL SOUSSI','MANAL','0690986644','elsoussi.manal@gmail.com'),
('EL HILALLI','ACHRAF','0670987700','elhilalli.achraf@gmail.com','EL KORCHI','FATIMA','0699987644','elkorchi.fatima@gmail.com');


Insert into Etudiant (nomEtudiant,prenomEtudiant,dateNaissanceEtudiant,
    lieuNaissanceEtudiant,addresse,codeCivilite,photo,emailEtudiant,telEtudiant,codeParent) values
    ('EL ABDELLAOUI', 'ESSEDIK','2001/03/14','SALE MAROC','N6 RUE MHAMID EL GHIZLANE PEPINIERE TABRIQUET SALE', 'M','heiji.jpg','t@gmail.com','0654342345',1),
    ('MARWA', 'HICHAM','2001/05/28','RABAT MAROC','N200 RUE AL ATLASS PEPINIERE TABRIQUET SALE', 'M','shinishi.jpg','i@gmail.com','0656642345',2),
    ('EL MAHDAOUI', 'HAJAR','2001/11/06','TEMERA MAROC','N66 RUE LALLA AMINA RABAT', 'F','haibara.jpg','p@gmail.com','0654772345',3),
    ('EL FQUIH', 'YOUNESS','2000/07/01','TANGER MAROC','TILIOUIN  SALE', 'M','yukiko.jpg','u@gmail.com','0654882345',4),
    ('EL HILALLI', 'SALMA','2001/08/10','CASABLANCA MAROC','N6 RUE 489 RABAT', 'M','ayumi.jpg','e@gmail.com','0654992345',5);


Insert into EtudiantAnneeScolaire(idEtudiant, idNiveau, anneScolaire, doublons)
values (1,3,'2020/2021',0),
 (2,3,'2020/2021',0),
 (3,2,'2020/2021',0),
(4,2,'2020/2021',0),
 (5,1,'2020/2021',0);

 Insert into Periode (nomPeriod) Values
 ('Pre inscription'),
 ('Octobre'),
 ('Janvier'),
 ('Avril');

Insert into Tarif (codePeriode,idNiveau,prix) Values
(1,1,3000),
(2,1,19000),
(3,1,19000),
(4,1,19000),
(1,2,3000),
(2,2,19000),
(3,2,19000),
(4,2,19000),
(1,3,3000),
(2,3,19000),
(3,3,19000),
(4,3,19000);
