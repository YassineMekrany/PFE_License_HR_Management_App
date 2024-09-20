-- La Base de Données de Projet de fin d'études 
-- Intitulé : Gestion des ressources humaines de laboratoire de doctorat
--tableau activite
CREATE TABLE activite (
  id_act int(10) NOT NULL AUTO_INCREMENT,
  type varchar(255) COLLATE latin1_swedish_ci NOT NULL,
  resume varchar(500) COLLATE latin1_swedish_ci NOT NULL,
  date_act date DEFAULT NULL,
  lieu varchar(100) COLLATE latin1_swedish_ci NOT NULL,
  id_d int(11) NOT NULL,
  id_p int(11) NOT NULL,
  approverProf int(11) DEFAULT '0',
  approverAdm int(11) DEFAULT '0',
  PRIMARY KEY (id_act)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--tableau administration
CREATE TABLE `administration` (
  `id_ad` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) COLLATE latin1_swedish_ci NOT NULL,
  `prenom` varchar(200) COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_swedish_ci NOT NULL,
  `telephone` varchar(20) COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(500) COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_ad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--insérer une administration pour tout va fonctionner bien le mot de passe est : 1234
INSERT INTO administration (nom, prenom, email, telephone, password) 
VALUES ('SAYOURI', 'SALAHEDDINE', 'salaheddine.sayouri@usmba.ac.ma', '0673785288', '$2y$10$Hpl2ikO3mAYP61ZrRFk21Oa7Tzqfo0MlYZUzD.W6hJFIhkeCADulK');

--tableau annonce
CREATE TABLE annonce (
  id_an int(11) NOT NULL AUTO_INCREMENT,
  message varchar(255) COLLATE latin1_swedish_ci DEFAULT NULL,
  date_deb date DEFAULT NULL,
  date_lim date DEFAULT NULL,
  Activer int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (id_an)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--insérer quelques Annonces :

INSERT INTO annonce (id, titre, date_debut, date_fin, publie)
VALUES 
(1, 'Demande Rejoindre au Labo comme Professeur', '2023-04-26', '2023-05-07', 1),
(2, 'Réinscription', '2023-04-27', '2023-05-05', 1),
(3, 'Préinscription', '2023-04-27', '2023-05-06', 1),
(4, 'Soutenance de Doctorat', '2023-04-27', '2023-05-01', 0),
(5, 'Conférence', '2023-04-27', '2023-05-01', 1);


--tableau doctorants 
CREATE TABLE doctorants (
  id_d int(11) NOT NULL AUTO_INCREMENT,
  nom varchar(200) COLLATE latin1_swedish_ci NOT NULL,
  prenom varchar(200) COLLATE latin1_swedish_ci NOT NULL,
  email varchar(255) COLLATE latin1_swedish_ci NOT NULL,
  id_encadrant int(20) NOT NULL,
  sujet varchar(255) COLLATE latin1_swedish_ci NOT NULL,
  telephone varchar(20) COLLATE latin1_swedish_ci NOT NULL,
  CNE varchar(20) COLLATE latin1_swedish_ci NOT NULL,
  DateInscr year(4) NOT NULL,
  password varchar(500) COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (id_d)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--tableau doctorantsappr
CREATE TABLE doctorantsappr (
  id_d int(11) NOT NULL AUTO_INCREMENT,
  nom varchar(200) COLLATE latin1_swedish_ci NOT NULL,
  prenom varchar(200) COLLATE latin1_swedish_ci NOT NULL,
  email varchar(200) COLLATE latin1_swedish_ci NOT NULL,
  id_encadrant int(20) NOT NULL,
  sujet varchar(255) COLLATE latin1_swedish_ci NOT NULL,
  telephone varchar(20) COLLATE latin1_swedish_ci NOT NULL,
  CNE varchar(20) COLLATE latin1_swedish_ci NOT NULL,
  password varchar(500) COLLATE latin1_swedish_ci NOT NULL,
  approverProf int(11) NOT NULL DEFAULT '0',
  approverAdm int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (id_d)
);

--tableau messages
CREATE TABLE messages (
  id INT(11) PRIMARY KEY AUTO_INCREMENT,
  receiver_id INT(11) NOT NULL,
  sender_id INT(11) NOT NULL,
  message VARCHAR(255) COLLATE latin1_swedish_ci NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  sender_type VARCHAR(30) COLLATE latin1_swedish_ci NOT NULL,
  receiver_type VARCHAR(30) COLLATE latin1_swedish_ci NOT NULL,
  status TINYINT(1) DEFAULT 0
);

--tableau notifications
CREATE TABLE notifications (
  id INT(11) PRIMARY KEY AUTO_INCREMENT,
  receiver_type VARCHAR(20) NOT NULL,
  receiver_id INT(11) NOT NULL,
  sender_id INT(11) NOT NULL,
  sender_type VARCHAR(20) NOT NULL,
  notification VARCHAR(255) NOT NULL,
  date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  type VARCHAR(20) NOT NULL,
  id_type INT(11) NOT NULL,
  status TINYINT(1) NOT NULL DEFAULT 0
);

--tableau organisation
CREATE TABLE organisation (
  id_org int(11) NOT NULL AUTO_INCREMENT,
  ids_p varchar(500) COLLATE latin1_swedish_ci NOT NULL,
  ids_d varchar(500) COLLATE latin1_swedish_ci NOT NULL,
  date_org date NOT NULL,
  lieu varchar(255) COLLATE latin1_swedish_ci NOT NULL,
  sujet varchar(255) COLLATE latin1_swedish_ci NOT NULL,
  approverAdm int(11) DEFAULT '0',
  PRIMARY KEY (id_org)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--tableau professeurs
CREATE TABLE professeurs (
  id_p int(11) NOT NULL AUTO_INCREMENT,
  nom varchar(200) COLLATE latin1_swedish_ci NOT NULL,
  prenom varchar(200) COLLATE latin1_swedish_ci NOT NULL,
  email varchar(200) COLLATE latin1_swedish_ci NOT NULL,
  specialite varchar(200) COLLATE latin1_swedish_ci NOT NULL,
  telephone varchar(20) COLLATE latin1_swedish_ci NOT NULL,
  password varchar(500) COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (id_p)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--tableau professeursappr
CREATE TABLE professeursappr (
  id_p int(11) NOT NULL AUTO_INCREMENT,
  nom varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  prenom varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  email varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  specialite varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  telephone varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  password varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (id_p)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--tableau publication
CREATE TABLE publication (
  id_pub int(10) PRIMARY KEY AUTO_INCREMENT,
  titre varchar(200),
  rang varchar(200),
  id_d int(10),
  journal varchar(200),
  resume varchar(255),
  date_pub date,
  approverProf int(1) NOT NULL DEFAULT 0,
  approverAdm int(1) NOT NULL DEFAULT 0
);

