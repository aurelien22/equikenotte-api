INSERT INTO mydb.dentistes(nom, prenom, adresse, codePostal, ville, telephone, email, siret, login, mdp) VALUES ('serret', 'leslie', '39 rue ange de guernisac', '29600', 'morlaix', '0681626347', 'l.serret@gmail.com', '83208269700026', 'lserret', 'password');
INSERT INTO mydb.dentistes(nom, prenom, adresse, codePostal, ville, telephone, email, siret, login, mdp) VALUES ('lecollinet', 'patrick', '2 rue jean mermoz', '35400', 'saint-malo', '0681626041', 'p.lecollinet@gmail.com', '38238203400041', 'plecollinet', 'password');

select * from mydb.dentistes;

INSERT INTO mydb.clients(nom, prenom, adresse, codePostal, ville, dentistes_idDentiste) VALUES ('pellan', 'frederique', '3 la ville men', '22240', 'frehel', 1);
INSERT INTO mydb.clients(nom, prenom, adresse, codePostal, ville, dentistes_idDentiste) VALUES ('le tohic', 'nadine', '2 lepine', '22240', 'frehel', 1);
INSERT INTO mydb.clients(nom, prenom, adresse, codePostal, ville, dentistes_idDentiste) VALUES ('dincuff', 'aurelien', '5 rue de claire vue', '22240', 'frehel', 2);
INSERT INTO mydb.clients(nom, prenom, adresse, codePostal, ville, dentistes_idDentiste) VALUES ('bouyou', 'jennifer', '5 rue de claire vue', '22240', 'frehel', 1);
INSERT INTO mydb.clients(nom, prenom, adresse, codePostal, ville, dentistes_idDentiste) VALUES ('dincuff', 'aliya', '5 rue de claire vue', '22240', 'frehel', 2);

select * from mydb.clients;

INSERT INTO mydb.chevaux(nom, numeroSire, anneeNaissance, idClient) VALUES ('discrete camara', '13389321P', 2013, 1);
INSERT INTO mydb.chevaux(nom, numeroSire, anneeNaissance, idClient) VALUES ('filou de kerduff', '15195278S', 2015, 2);
INSERT INTO mydb.chevaux(nom, numeroSire, anneeNaissance, idClient) VALUES ('joly girl', '19309845M', 2019, 3);
INSERT INTO mydb.chevaux(nom, numeroSire, anneeNaissance, idClient) VALUES ('indiana first', '18107917F', 2018, 3);
INSERT INTO mydb.chevaux(nom, numeroSire, anneeNaissance, idClient) VALUES ('jakyria camara', '19337248B', 2019, 4);
INSERT INTO mydb.chevaux(nom, numeroSire, anneeNaissance, idClient) VALUES ('inanga camara', '18198908C', 2018, 4);
INSERT INTO mydb.chevaux(nom, numeroSire, anneeNaissance, idClient) VALUES ('fanfan', '52386057H', 2005, 5);

select * from mydb.chevaux;
select * from mydb.chevaux where idClient = 4;
select * from mydb.clients cl inner join mydb.chevaux ch ON ch.idClient = cl.idClient where cl.nom like 'dincuff' AND cl.prenom LIKE 'aurelien';

INSERT INTO mydb.tauxTva(taux) VALUES (5.5);
INSERT INTO mydb.tauxTva(taux) VALUES (10);
INSERT INTO mydb.tauxTva(taux) VALUES (20);

select * from mydb.tauxTva;
alter table mydb.tauxTva modify taux DECIMAL(3,1);

INSERT INTO mydb.prestations(designation, prixHt, idTauxTva ) VALUES ('Consultation et nivellement', '60', 3);
INSERT INTO mydb.prestations(designation, prixHt, idTauxTva ) VALUES ('Extraction des dents de loup', '30', 3);
INSERT INTO mydb.prestations(designation, prixHt, idTauxTva ) VALUES ('Tranquilisation', '10', 3);
INSERT INTO mydb.prestations(designation, prixHt, idTauxTva ) VALUES ('Déplacement kilométrique', '0.5', 3);

select * from mydb.prestations;







