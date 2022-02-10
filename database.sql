-- MySQL dump 10.13  Distrib 8.0.28, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: world_wide_job
-- ------------------------------------------------------
-- Server version	8.0.28-0ubuntu0.20.04.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `application`
--

DROP TABLE IF EXISTS `application`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `application` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` int DEFAULT NULL,
  `offer_id` int NOT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A45BDDC1CB944F1A` (`student_id`),
  KEY `IDX_A45BDDC153C674EE` (`offer_id`),
  CONSTRAINT `FK_A45BDDC153C674EE` FOREIGN KEY (`offer_id`) REFERENCES `offer` (`id`),
  CONSTRAINT `FK_A45BDDC1CB944F1A` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application`
--

LOCK TABLES `application` WRITE;
/*!40000 ALTER TABLE `application` DISABLE KEYS */;
INSERT INTO `application` VALUES (108,121,67,1),(109,122,64,1),(110,123,49,1),(111,123,64,1),(112,124,64,1),(113,125,66,1),(114,125,67,1),(115,127,47,1),(116,127,65,1),(117,128,47,1),(118,128,51,1),(119,128,67,1),(120,129,47,1),(121,129,51,1),(122,129,65,1);
/*!40000 ALTER TABLE `application` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_format` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siren` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `updated_at` datetime DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_4FBF094FA76ED395` (`user_id`),
  UNIQUE KEY `UNIQ_4FBF094F989D9B62` (`slug`),
  CONSTRAINT `FK_4FBF094FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (16,406,'lvmh-6203de12bcefb101267962.jpg','LVMH','6','328 478 094 00035','328 478 094','LVMH Moët Hennessy Louis Vuitton SE est un groupe français d\'entreprises fondé par Alain Chevalier et Henry Racamier, aujourd\'hui chef de file mondial de l\'industrie du luxe quant au chiffre d\'affaires.\r\nIl est actuellement dirigé par l\'homme d\'affaires Bernard Arnault.\r\n\r\nLa firme est numéro un mondial du luxe avec un portefeuille de plus de soixante-dix marques de prestige dans le domaine des vins et spiritueux avec notamment Château d\'Yquem, Moët & Chandon, Veuve Cliquot, Krug, Hennessy et Glenmorangie, ainsi que dans le domaine de la mode et joaillerie avec Louis Vuitton, Dior, Givenchy, Céline, Kenzo, Fendi, Guerlain, Marc Jacobs, Chaumet, Thomas Pink, Tiffany & Co. et Bulgari. Il est également présent dans le domaine des médias, avec notamment Les Échos, Le Parisien et Radio Classique, dans la distribution avec Sephora et Le Bon Marché, et dans l’hôtellerie de luxe avec notamment le palace Cheval Blanc Courchevel et le rachat du groupe d\'hôtellerie Belmond.','2022-02-09 16:30:26','lvmh',1),(17,407,'dassault-6203e1b10d920438441994.jpg','Dassault','6','71204245600111','712042456','Le groupe Dassault Aviation est un constructeur aéronautique français fondé en 1929 par Marcel Bloch et reste le dernier groupe d\'aviation au monde détenu par la famille de son fondateur et portant son nom.\r\n\r\nC\'est une entreprise multinationale qui emploie 12 757 personnes, dont 9 700 en France avec une flotte recensant plus de 2 100 avions d\'affaires Falcon en service et plus de 1 000 avions de combat en service dans 90 pays.\r\nSes activités, couvrant l’amont (conception et développement) et l’aval (vente et support)3 s’organisent autour de :\r\n- l’aéronautique avec la création d’une centaine de prototypes et la vente de plus de 10 000 avions4 depuis 1945, principalement des avions d\'affaires qui représentent 30 % de l\'activité en 2019 (Falcon) et également des avions militaires (Mirage 2000, Rafale) ;\r\n- les activités spatiales (études des véhicules spatiaux, systèmes sols de télémesure et activités pyrotechniques) ;\r\n- les services (Dassault Procurement Services, Dassault Falcon Jet et Dassault Falcon Service) ;\r\n- les produits et services aux systèmes d’aéronautiques et de défense (Sogitec Industries).','2022-02-09 16:45:53','dassault',1),(24,558,'airbus-6203feb921027402057277.png','Aitbus Helicopters','6','35238371500021','352383715','Airbus Helicopters est le premier fabricant d\'hélicoptères civils au monde et l\'un des principaux constructeurs d\'hélicoptères militaires. Il fut créé sous le nom d\'Eurocopter en 1992 à partir de la fusion des divisions hélicoptères de l\'entreprise française Aérospatiale (SNIAS) et de l\'entreprise allemande Deutsche Aerospace (DASA).\r\nLe siège de la société est installé dans le sud de la France à Marignane, près de Marseille, où elle possède son principal site de production en France, l\'autre se situant à Dugny, près de Paris. Le site emploi plus de 5000 personnes dans le bassin marseillais.','2022-02-09 18:49:45','aitbus-helicopters',1),(25,559,'edf-62040737c6e42236250790.png','EDF','6','55208131766522','552081317','L\'entreprise est le premier producteur et le premier fournisseur d’électricité en France et en Europe.','2022-02-09 19:25:59','edf',1),(26,560,'sanofi-6204083412456833504354.png','Sanofi','6','34950537000131','349505370','Sanofi est une entreprise transnationale française dont les activités incluent la pharmacie (notamment des médicaments de prescription dans les domaines du diabète, des maladies rares, de la sclérose en plaques et de l\'oncologie et des produits de santé grand public) et les vaccins.','2022-02-09 19:30:12','sanofi',1);
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `curriculum`
--

DROP TABLE IF EXISTS `curriculum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `curriculum` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` int NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skills` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driving_licence` tinyint(1) DEFAULT NULL,
  `cv_type` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_7BE2A7C3CB944F1A` (`student_id`),
  CONSTRAINT `FK_7BE2A7C3CB944F1A` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curriculum`
--

LOCK TABLES `curriculum` WRITE;
/*!40000 ALTER TABLE `curriculum` DISABLE KEYS */;
INSERT INTO `curriculum` VALUES (17,129,'student8-6204123f1b228666443486.jpeg','Technicien de maintenance\r\nDéveloppement web (Symfony)','Français, Anglais, Chinois',1,NULL,'2022-02-09 20:13:03'),(18,128,'student7-620436562ee6a109657216.jpeg','Artiste, Créative\r\nDéveloppement Web et Mobile','Français, Anglais, Espagnol; Russe',0,NULL,'2022-02-09 22:47:02'),(19,127,'student6-620437e4b81a3471720766.jpeg','Musique, artiste\r\nDéveloppement Web (NodeJS)','Français, Anglais, Italien',0,NULL,'2022-02-09 22:53:40'),(20,125,'student4-6204390be2c58442886652.jpeg','Techniques de laboratoire\r\nBiologie\r\nIngénierie\r\nManagement','Français, Anglais, Arabe',1,NULL,'2022-02-09 22:58:35'),(21,126,'student5-62043ab309a8b192862455.jpeg','Techniques de la laboratoire\r\nBiologie\r\nIngénierie\r\nManagement','Français, Anglais, Allemand',1,NULL,'2022-02-09 23:05:39'),(22,124,'student3-62043d36ed660759184479.jpeg','Ordonnée, passionnée\r\nCulture générale\r\nBibliothécaire\r\nLogistique','Français, Anglais, Russe',1,NULL,'2022-02-09 23:16:22'),(23,123,'student2-62043e7283ed2860072417.jpeg','Logistique\r\nOrganisé\r\nPassionné','Français, Anglais, Espagnol, Indien',1,NULL,'2022-02-09 23:21:38'),(24,122,'student1-6204412b7fdd2475266362.jpeg','Organisée, sérieuse\r\nDanseuse de claquettes\r\nLogistique','Français, Anglais, Italien, Irlandais',1,NULL,'2022-02-09 23:33:15'),(25,121,'sutdent0-620441c369c2c935229659.jpeg','Curieux, passionné\r\nRigoureux\r\nBiologie\r\nIngénierie','Français, Anglais, Italien',1,NULL,'2022-02-09 23:35:47');
/*!40000 ALTER TABLE `curriculum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `degree`
--

DROP TABLE IF EXISTS `degree`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `degree` (
  `id` int NOT NULL AUTO_INCREMENT,
  `school_id` int NOT NULL,
  `degree` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A7A36D63C32A47EE` (`school_id`),
  CONSTRAINT `FK_A7A36D63C32A47EE` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `degree`
--

LOCK TABLES `degree` WRITE;
/*!40000 ALTER TABLE `degree` DISABLE KEYS */;
/*!40000 ALTER TABLE `degree` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20211221160524','2022-01-28 16:00:59',692),('DoctrineMigrations\\Version20211222085751','2022-01-28 16:00:59',12),('DoctrineMigrations\\Version20211222180101','2022-01-28 16:00:59',34),('DoctrineMigrations\\Version20220104154101','2022-01-28 16:00:59',70),('DoctrineMigrations\\Version20220108200100','2022-01-28 16:01:00',58),('DoctrineMigrations\\Version20220108201846','2022-01-28 16:01:00',12),('DoctrineMigrations\\Version20220113082313','2022-01-28 16:01:00',10),('DoctrineMigrations\\Version20220113104059','2022-01-28 16:01:00',10),('DoctrineMigrations\\Version20220126085305','2022-01-28 16:01:00',12),('DoctrineMigrations\\Version20220126132746','2022-01-28 16:01:00',82),('DoctrineMigrations\\Version20220127140713','2022-01-28 16:01:00',13),('DoctrineMigrations\\Version20220128114033','2022-01-28 16:01:00',34);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `experience`
--

DROP TABLE IF EXISTS `experience`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `experience` (
  `id` int NOT NULL AUTO_INCREMENT,
  `curriculum_id` int NOT NULL,
  `job_position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localisation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_type` int DEFAULT NULL,
  `date_in` date DEFAULT NULL,
  `date_out` date DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_590C1035AEA4428` (`curriculum_id`),
  CONSTRAINT `FK_590C1035AEA4428` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `experience`
--

LOCK TABLES `experience` WRITE;
/*!40000 ALTER TABLE `experience` DISABLE KEYS */;
INSERT INTO `experience` VALUES (49,17,'Technicien de maintenance','SEB','Rumilly (74)',1,'2011-07-15','2021-08-16','Maintenance des diverses machines de la chaine de production de l\'entreprise'),(50,18,'Serveuse','Café des arts et Métiers','51 Rue de Turbigo, 75003 Paris',2,'2017-07-15','2018-01-04','Service à table et au comptoir'),(51,19,'Serveur','Café des arts et Métiers','51 Rue de Turbigo, 75003 Paris',2,'2020-08-01','2020-08-31','Service à table et au comptoir.'),(52,20,'Baby-sitter','Privée','Marseille',2,'2017-07-01','2022-07-01','Gardes d\'enfants occasionnelles'),(53,21,'Serveuse','Bar Rock\'n\'Eat','Lyon',2,'2018-07-01','2023-06-30','Divers extras le soir, le week-end et pendant les vacances.'),(54,22,'Documentaliste','Lycée Notre Dame De Fidélité','Caen',2,'2011-09-01','2012-06-30',NULL),(55,22,'Bibliothécaire','Bibliothèque municipale Alexis de Tocqueville','Caen',1,'2012-07-11','2019-05-30',NULL),(56,23,'Serveur','Tabarnak Bar','Nantes',2,'2018-09-01','2022-06-30','Divers extras le soir, week-end ou vacances.'),(57,23,'Caissier','Carrefour Nantes Saint Herblain','Nantes',1,'2016-07-04','2018-08-31',NULL),(58,24,'Serveuse','Temple Bar','Dublin - Irlande',1,'2013-07-01','2016-09-01',NULL),(59,24,'Professeur d\'Irlandais','Acadomia','Caen',2,'2016-09-02','2017-11-21',NULL),(60,24,'Caissière','Carrefour Hérouville Saint Clair','Caen',1,'2017-11-29','2019-08-15',NULL),(61,25,'Baby-sitter','Privée','Marseille',2,'2015-09-01','2022-06-30','Gardes ponctuelles d\'enfants.');
/*!40000 ALTER TABLE `experience` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offer`
--

DROP TABLE IF EXISTS `offer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `offer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_type` int DEFAULT NULL,
  `duration` int DEFAULT NULL,
  `short_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_publication` datetime DEFAULT NULL,
  `long_description` longtext COLLATE utf8mb4_unicode_ci,
  `field_of_activity` int DEFAULT NULL,
  `job_position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_in` date DEFAULT NULL,
  `wage` int DEFAULT NULL,
  `tutor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driving_licence` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_29D6873E979B1AD6` (`company_id`),
  CONSTRAINT `FK_29D6873E979B1AD6` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offer`
--

LOCK TABLES `offer` WRITE;
/*!40000 ALTER TABLE `offer` DISABLE KEYS */;
INSERT INTO `offer` VALUES (47,17,'Alternance - Développement Web','Velizy-Villacoublay',2,5,'Offre alternance dans le domaine du développement web','2022-02-09 15:37:53','',1,NULL,'2022-05-02',1400,'Romain Devilliers',0,1),(48,16,'Offre de stage - Commerce','Lyon',1,4,'Recherche vendeur(se) pour boutique de luxe','2022-02-09 15:37:53','',13,NULL,'2021-03-12',2000,'Mathieu Dupont',0,1),(49,16,'Offre de stage - Asistant Logistique','Cergy',3,1,'Cherche assistant logistique','2022-02-09 15:37:53','',47,NULL,'2021-04-01',1,'Candice Renard',1,1),(51,17,'Offre de stage - Technicien de maintenance','Annecy',3,6,'Stage de fin d\'études en usine','2022-02-09 15:37:53','',1,NULL,'2022-06-01',1,'Christian Blanc',0,1),(62,24,'Stage - Assistant ingénieur','Marignane',3,NULL,'Stagiaire en BTS ATI','2022-02-09 19:09:45',NULL,1,NULL,'2022-05-02',1,'Charles Trécourt',1,1),(63,24,'Stage - Logistique','Marignane',5,NULL,'Stagiaire en logistique','2022-02-09 19:12:28',NULL,1,NULL,'2022-03-01',900,'Mathieu Gerard',1,1),(64,25,'Offre de stage - Logistique','Caen',5,NULL,'Alternance en logistique','2022-02-09 19:26:43',NULL,47,NULL,'2022-09-01',1300,'Jean Baptiste Perrin',1,1),(65,25,'Alternance - Application mobile','Paris',1,NULL,'Alternance pour développeur d\'application mobile','2022-02-09 19:27:25',NULL,28,NULL,'2022-09-01',1300,'Jean Fontaine',0,1),(66,26,'Stage - Technicien de laboratoire','Lyon',4,NULL,'Recherche stagiaire en BTS technicien de laboratoire','2022-02-09 19:31:27',NULL,34,NULL,'2022-03-01',800,'Corine Toucan',0,1),(67,26,'Alternance - Assistant ingénieur','Lyon',1,NULL,'Cherche assistant d\'ingénieur en biologie','2022-02-09 19:34:10',NULL,10,NULL,'2022-09-05',1400,'Martine Roger',0,1);
/*!40000 ALTER TABLE `offer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `school`
--

DROP TABLE IF EXISTS `school`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `school` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_desc` longtext COLLATE utf8mb4_unicode_ci,
  `type` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F99EDABBA76ED395` (`user_id`),
  CONSTRAINT `FK_F99EDABBA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `school`
--

LOCK TABLES `school` WRITE;
/*!40000 ALTER TABLE `school` DISABLE KEYS */;
INSERT INTO `school` VALUES (21,554,'univnantes-6203f0876b4c0876646469.jpg','Nantes Universite','BUT Qualité, Logistique Industrielle et Organisation','Parcours proposés :Parcours Management de la production de biens et de services, Parcours Pilotage de la chaine logistique globale, Parcours Qualité et pilotage des systèmes de management intégrés, Parcours Accompagnement à la transformation numérique.\r\nCampus La Fleuriaye à Carquefou\r\nDurée de la formation : 3 ans',1,'2022-02-09 17:49:11','nantes-universite',1),(22,555,'polytech-6203f1bf273c9836695182.png','Polytech Marseille','Ingénieur spécialité Génie Biologique','Cette filière forme des ingénieurs de haut niveau scientifique et technique dans le domaine des biotechnologies, spécialistes des applications les plus avancées de la microbiologie et de la biologie cellulaire (biologie moléculaire, culture cellulaire, génie génétique, génie biochimique, génomique....). Elle est orientée vers la conception, la réalisation et la mise en œuvre de nouveaux produits et procédés biologiques, comprenant la production, l’extraction et la purification de produits biologiques mettant en oeuvre des microorganismes, des cellules animales ou végétales. Cette formation propose également la maîtrise des techniques analytiques et des méthodologies permettant d’assurer le contrôle de la qualité et de la sécurité des composés issus des bioprocédés...\r\n\r\nFinalement les ingénieurs Polytech sont introduits à la vie en entreprise et à la gestion de leur carrière, notre formation donnant une emphase toute particulière à leur capacité de communication, d’actualisation, d’innovation et d’animation d’équipes.\r\nNombre moyen d\'élèves dans une promotion : 30\r\nProfils des élèves à l\'entrée* : Sciences de la vie, biologie\r\nDomaines de formation concernés (parmi les 12 domaines du réseau Polytech) : Génie biologique et alimentaire\r\nParcours possibles : Formation Initiale (FI), Formation Continue (FC), Contrat de Professionnalisation en dernière année (CP)',2,'2022-02-09 17:54:23','polytech-marseille',1),(23,556,'wcs-6203f28e919fd746426032.png','Wild Code School','Développement Web et Mobile','La Wild Code School est une école innovante et un réseau européen de campus qui forment aux métiers tech des spécialistes adaptables. C\'est une marque de la société Innov\'Educ. Après s\'être historiquement développée sur le métier de développeur web (PHP, Javascript, Java/Android), l\'école propose aujourd\'hui des formations autour de six grands domaines: le développement informatique, la data, la cybersécurité, le product management, l\'UX/UI Design et le business développement 2.0. Elle forme essentiellement des adultes en reconversion professionnelle sur des formats courts de trois à cinq mois.',3,'2022-02-09 17:57:50','wild-code-school',1);
/*!40000 ALTER TABLE `school` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `school_id` int NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ine` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B723AF33A76ED395` (`user_id`),
  UNIQUE KEY `UNIQ_B723AF33F85E0677` (`username`),
  KEY `IDX_B723AF33C32A47EE` (`school_id`),
  CONSTRAINT `FK_B723AF33A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_B723AF33C32A47EE` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (121,561,22,'sutdent0-620409ab6644c505628751.jpeg','15632598542','2022-02-09 19:36:27','clemartin','clemartin','<p>Jeune passion&eacute; par la biologie et la vie de laboratoire, je suis &agrave; la recherche d&#39;un stage dans le but de finaliser ma formation &agrave; l&#39;&eacute;cole Polytechnique de Marseille.</p>',1),(122,562,21,'student1-62040adbaff4a278403805.jpeg','965824563258','2022-02-09 19:41:31','gaellep','gaellep','<p>Ayant re&ccedil;u une formation en logistique &agrave; l&#39;universit&eacute; de Nantes, je cherche actuellement un stage de fin de formation.</p>',1),(123,563,21,'student2-62040bb159675430311024.jpeg','896524695873','2022-02-09 19:45:05','indianboy','indianboy','<p>Finissant acutellement ma formation en logistique &agrave; l&#39;universit&eacute; de Nantes, je suis &agrave; la recherche d&#39;un stage ou d&#39;une alternance.&nbsp;</p>',1),(124,564,21,'student3-62040c9a20f40066116608.jpeg','76514236958','2022-02-09 19:48:58','clairette','clairette','<p>En reconversion apr&egrave;s un dipl&ocirc;me de bibliot&eacute;caire, je cherche actuellement un stage afin de valider mon diplome de logistique.</p>',1),(125,565,22,'student4-62040d966800e201085318.jpeg','89624365195','2022-02-09 19:53:10','mohamedb','mohamedb','<p>Je suis &agrave; la recherche d&#39;une alternance ou d&#39;un stage pour ma derni&egrave;re ann&eacute;e d&#39;&eacute;cole d&#39;ing&eacute;nieur.</p>',1),(126,566,22,'student5-62040e64c3f8a784900303.jpeg','78926514536','2022-02-09 19:56:36','chacha69','chacha69','<p>D&#39;origine lyonnaise, je recherche un stage dans ma ville de naissance dans le cadre de mes &eacute;tudes d&#39;inganieur.</p>',1),(127,567,23,'student6-62040f10960d7673196292.jpeg','786254365129','2022-02-09 19:59:28','steeeven','steeeven','<p>Passionn&eacute; par l&#39;informatique et le d&eacute;veloppement web, je recherche un stage afin de finaliser ma formation.</p>',1),(128,568,23,'student7-62040fb599b60259524990.jpeg','7632541365856','2022-02-09 20:02:13','littlebird','littlebird','<p>Nomade et atypique, je suis &agrave; la recherche d&#39;un stage pouvant s&#39;&eacute;ffectuer en remote dans le cadre de ma formation &agrave; la Wild Code School</p>',1),(129,569,23,'student8-620410c084077889660355.jpeg','75364123659','2022-02-09 20:06:40','chang74','chang74','<p>Ancien technicien de maintenance passionn&eacute; par l&#39;informatique, je suis actuellement en reconvertion &agrave; la Wild Code School. Je recherche donc un stage ou une alternance dans le domaine du d&eacute;veloppement web.</p>',1);
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_degree`
--

DROP TABLE IF EXISTS `student_degree`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_degree` (
  `student_id` int NOT NULL,
  `degree_id` int NOT NULL,
  PRIMARY KEY (`student_id`,`degree_id`),
  KEY `IDX_2995B5E3CB944F1A` (`student_id`),
  KEY `IDX_2995B5E3B35C5756` (`degree_id`),
  CONSTRAINT `FK_2995B5E3B35C5756` FOREIGN KEY (`degree_id`) REFERENCES `degree` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_2995B5E3CB944F1A` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_degree`
--

LOCK TABLES `student_degree` WRITE;
/*!40000 ALTER TABLE `student_degree` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_degree` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_offer`
--

DROP TABLE IF EXISTS `student_offer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_offer` (
  `student_id` int NOT NULL,
  `offer_id` int NOT NULL,
  PRIMARY KEY (`student_id`,`offer_id`),
  KEY `IDX_A1E1FEA3CB944F1A` (`student_id`),
  KEY `IDX_A1E1FEA353C674EE` (`offer_id`),
  CONSTRAINT `FK_A1E1FEA353C674EE` FOREIGN KEY (`offer_id`) REFERENCES `offer` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_A1E1FEA3CB944F1A` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_offer`
--

LOCK TABLES `student_offer` WRITE;
/*!40000 ALTER TABLE `student_offer` DISABLE KEYS */;
INSERT INTO `student_offer` VALUES (123,49),(129,47),(129,51);
/*!40000 ALTER TABLE `student_offer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `training`
--

DROP TABLE IF EXISTS `training`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `training` (
  `id` int NOT NULL AUTO_INCREMENT,
  `curriculum_id` int NOT NULL,
  `field_of_study` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `degree` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `graduate` tinyint(1) DEFAULT NULL,
  `date_in` date DEFAULT NULL,
  `date_out` date DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_D5128A8F5AEA4428` (`curriculum_id`),
  CONSTRAINT `FK_D5128A8F5AEA4428` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `training`
--

LOCK TABLES `training` WRITE;
/*!40000 ALTER TABLE `training` DISABLE KEYS */;
INSERT INTO `training` VALUES (49,17,NULL,'Lycée polyvalent Louis Lachenal - Annecy','BTS Maintenance des systèmes de production',NULL,'2009-09-01','2011-06-30','Le BTS MS forme des spécialistes de la maintenance et apporte aux élèves des compétences technologiques, organisationnelles et relationnelles. Les enseignements pluritechnologiques (électrotechnique, mécanique, automatique, hydraulique) rendent l\'élève capable de détecter une panne, de diagnostiquer les dysfonctionnements, d\'établir le plan de réparation et d\'assurer la remise en service de l\'installation.'),(50,18,NULL,'Lycée Auguste Renoir - Paris','Bac L option art',NULL,'2015-09-01','2017-06-30',NULL),(51,18,NULL,'Wild Code School - Paris','Développeur Web et Mobile',NULL,'2021-09-15','2022-02-11',NULL),(52,19,NULL,'Lycée Auguste Renoir - Paris','Bac L option musique',NULL,'2018-09-01','2020-06-30',NULL),(53,19,NULL,'Wild Code School - Paris','Développeur Web et Mobile',NULL,'2020-09-15','2022-06-30',NULL),(54,20,NULL,'Lycée du Rempart - Marseille','Bac S option physique-chimie',NULL,'2015-09-01','2017-06-30',NULL),(55,20,NULL,'Polytech Marseille','Ingénieur Polytech Marseille spécialité Génie Biologique',NULL,'2017-09-01','2022-06-30',NULL),(56,21,NULL,'Lycée du Parc - Lyon','Bac S option physique-chimie',NULL,'2016-09-01','2018-06-30',NULL),(57,21,NULL,'Polytech Marseille','Ingénieur Polytech Marseille spécialité Génie Biologique',NULL,'2018-09-01','2023-06-30',NULL),(58,22,NULL,'Lycée Notre Dame De Fidélité  - Caen','Bac L',NULL,'2006-09-01','2008-06-30',NULL),(59,22,NULL,'IUT Bordeaux Montaigne','Licence professionnelle métiers du livre : documentation et bibliothèque',NULL,'2008-09-01','2011-06-30',NULL),(60,22,NULL,'Nantes Université','BUT Qualité, Logistique Industrielle et Organisation',NULL,'2020-09-01','2022-06-30',NULL),(61,23,NULL,'Lycée Auguste Renoir - Paris','Bac ES option économie',NULL,'2014-09-01','2016-06-30',NULL),(62,23,NULL,'Nantes Université','BUT Qualité, Logistique Industrielle et Organisation',NULL,'2019-09-01','2022-06-30',NULL),(63,24,NULL,'Lycée Notre Dame De Fidélité  - Caen','Bac ES option économie',NULL,'2011-09-01','2013-06-30',NULL),(64,24,NULL,'Nantes Université','BUT Qualité, Logistique Industrielle et Organisation',NULL,'2019-09-01','2022-06-30',NULL),(65,25,NULL,'Lycée du Rempart - Marseille','Bac S option physique-chimie',NULL,'2015-09-01','2017-06-30',NULL),(66,25,NULL,'Polytech Marseille','Ingénieur Polytech Marseille spécialité Génie Biologique',NULL,'2017-09-01','2022-06-30',NULL);
/*!40000 ALTER TABLE `training` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `civility` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adress1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adress2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `last_connection` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=570 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (406,'company3@wwj.fr','[\"ROLE_COMPANY_COMPLETED\"]','$2y$13$Rj98uCW3tB2WCEjr7RdRi.eCqED1QOY/8c.rA44yXZ95pNUN.rM6a','Monsieur','Bernard','Arnault','1949-03-05','0682469756','10 Rue de Charenton','Res Le Bel Immeuble','Paris','75012','France',0,'2022-02-09'),(407,'company1@wwj.fr','[\"ROLE_COMPANY_COMPLETED\"]','$2y$13$k9qVvJ8cplkhWrYSCi27HuAl6Py8OMm0yPs8cl7IT2NcydU9dzttu','Monsieur','Eric','Trappier','1960-01-06','0685231652','4, place du Louvre',NULL,'Paris','75001','France',0,'2022-02-09'),(553,'admin@gmail.com','[\"ROLE_ADMIN\"]','$2y$13$SbsctAFA86otNmWCwJy4Y.3LqkALM0hoJYHD9gwhpE3Sqp.IIWctG','Monsieur','Jean','Dupont','2002-10-12','114752347','333 rue de la gerla','bis terrain du moulin','Saint Siméon de Bressieux','38870','France',0,NULL),(554,'school1@wwj.fr','[\"ROLE_SCHOOL_COMPLETED\"]','$2y$13$PY2LwveU0bRAX822ZEFSxurErte97D10IrKBeEX4UnPj8P0ZxyRcO','Madame','Carine','Bernault','1973-11-20','0689365248','1 quai de Tourville',NULL,'Nantes','44035','France',0,'2022-02-09'),(555,'school2@wwj.fr','[\"ROLE_SCHOOL_COMPLETED\"]','$2y$13$aSvajhsExCX.6Df.n1nnouZY6jDUHAvaXriiJFpud3c60pqOuewXi','Monsieur','Romain','Laffont','1980-08-10','0645962365','Campus Chateau Gombert',NULL,'Marseille','13013','France',0,'2022-02-09'),(556,'school0@wwj.fr','[\"ROLE_SCHOOL_COMPLETED\"]','$2y$13$iAcAp930iEl9KXq/Bm4/MOqqSLeSpxmStDvGnCzSA5eGZtg2NM1de','Madame','Anna','Stépanoff','1982-08-21','0689756412','18 rue de la Gare',NULL,'La Loupe','28240','France',0,'2022-02-09'),(558,'company0@wwj.fr','[\"ROLE_COMPANY_COMPLETED\"]','$2y$13$vZOXhFP8oNO0DOvK0DMgOu4sfdhUvK1hMvBLMgKAYZuYObckxPbvy','Monsieur','Bernard','Arnault','1968-03-15','0696564231','Aéroport Marseille Provence',NULL,'Marignane','13700','France',0,'2022-02-09'),(559,'company2@wwj.fr','[\"ROLE_COMPANY_COMPLETED\"]','$2y$13$p4kjhnMFQL0nB1kxOXSK5OCBreen2Fc01/du2F8yc30//Xv9i.dWO','Monsieur','Jean-Bernard','Levi','1955-03-18','0752416398','22, av de Wagram',NULL,'Paris','75008','France',0,'2022-02-09'),(560,'company4@wwj.fr','[\"ROLE_COMPANY_COMPLETED\"]','$2y$13$bQ96rzL34CZxlsTp2kVe/e48LKWMbP/ZF/RL7ducweb9omY4BfbFC','Monsieur','Serge','Weinberg','1951-02-10','0696457685','14 Espace Henri Vallée',NULL,'Lyon','69007','France',0,'2022-02-09'),(561,'student0@wwj.fr','[\"ROLE_STUDENT_COMPLETED\"]','$2y$13$mIsdWwKwGkXZ9Wr381KZyepKc09/3x2oxZXJEEI5.muOO3sb4.aCy','Monsieur','Clement','Martin','1999-05-05','0756495231','20 rue Pascal',NULL,'Marseille','13007','France',0,'2022-02-09'),(562,'student1@wwj.fr','[\"ROLE_STUDENT_COMPLETED\"]','$2y$13$YyWaLtdUSeFXNmzsTavxoO3FLAXvwXxSzUMK9FqAbScIb8XUwxsUC','Madame','Gaëlle','Smith','1995-05-01','0652463159','67 Rue Vermeulen',NULL,'Hérouville Saint Clair','14200','France',0,'2022-02-09'),(563,'student2@wwj.fr','[\"ROLE_STUDENT_COMPLETED\"]','$2y$13$k8FT2dc9piZFGv4jzYtLfui34U0VvNN.xuR/k.VjPmc2r2f4H7ZFi','Monsieur','Amrit','Jadhav','1998-08-16','0685341696','70, rue Corvisart',NULL,'Paris','75013','France',0,'2022-02-09'),(564,'student3@wwj.fr','[\"ROLE_STUDENT_COMPLETED\"]','$2y$13$.ixCfeEvwUl9vjtafudvO.N4.dIPIbVdxCR1RhKBU5qApApeIQAzS','Madame','Claire','Leblanc','1990-03-20','0689563215','12, rue d\'Hastings',NULL,'Caen','14000','France',0,'2022-02-09'),(565,'student4@wwj.fr','[\"ROLE_STUDENT_COMPLETED\"]','$2y$13$Pvc2BlLHgtvHQTZAqvzdbePX0GDpW.Sv94xRwrSukkkuDfr27/5D6','Monsieur','Mohamed','Belkassim','1999-11-09','0645968535','275, rue de Lyon',NULL,'Marseille','13015','France',0,'2022-02-09'),(566,'student5@wwj.fr','[\"ROLE_STUDENT_COMPLETED\"]','$2y$13$j4rnRrRykdtdrX2EkVkrOuDTzw6Cd/H8oaKs5wb5NFkYyI8NmF/cK','Madame','Charley','Abibi','2000-02-28','0846951369','81 rue Chevreul',NULL,'Lyon','69007','France',0,'2022-02-09'),(567,'student6@wwj.fr','[\"ROLE_STUDENT_COMPLETED\"]','$2y$13$wIeRVS8CetzqfyCf3a7wkegmwGCEaMqtE4jepnap9BzfjVl13XT3W','Monsieur','Steven','Brown','2002-07-18','0689356145','26 rue de Verdun',NULL,'Cachan','94230','France',0,'2022-02-09'),(568,'student7@wwj.fr','[\"ROLE_STUDENT_COMPLETED\"]','$2y$13$6yxIKifPG4k2ghSPsq2w.O4zUjgqtuKrpb6n5keRYLi6Lsl91LSoG','non-genré','Camille','Elder','1999-10-15','0796154632','36 rue Oger',NULL,'Bourg la Reine','92340','France',0,'2022-02-09'),(569,'student8@wwj.fr','[\"ROLE_STUDENT_COMPLETED\"]','$2y$13$aX2id95aEhlenMzNfSCvLeLhOqDlbiHrERm9Lzjzwx58AWoS5Z.qK','Monsieur','Chang','Tang','1991-07-10','0679851364','20 rue des Terreaux',NULL,'Rumilly','74150','France',0,'2022-02-09');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-02-09 23:50:55
