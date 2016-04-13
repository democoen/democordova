DROP TABLE IF EXISTS `address`;

CREATE TABLE `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `managerId` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `department` varchar(45) NOT NULL,
  `officePhone` varchar(45) NOT NULL,
  `cellPhone` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

LOCK TABLES `address` WRITE;
INSERT INTO address(firstName, lastName, managerId, title, department, officePhone, cellPhone, email, city) 
VALUES  ('Stefan','Koning',4,'Software Architect','IT','020-5628534','06-64926547','s.koning@gmail.com','Amsterdam'),
        ('Marie','Jansen',5,'Tester','IT','010-6683654','06-23764986','mariejansen@gmail.com','Rotterdam'),
        ('Stephanie','de Vries',5,'Webdesigner','IT','010-4583445','06-55835998','sdevries@gmail.com','Rotterdam'),
        ('Mark','Goossen',2,'Marketing director','Marketing','020-000-0009','06-44993678','m.goossen@gmail.com','Utrecht'),
        ('Jimmy','van Zadelhof',2,'Marketing executive','Marketing','020-0000008','06-98633498','jvanzadelhof@gmail.com','Hilversum'),
        ('Paul','Jansen',4,'Software developer','IT','020-0000007','06-20994672','pjansen@gmail.com','Kortenhoef'),
        ('Raoul','van de Meer',1,'VP of Sales','Sales','020-8534678','06-0000005','r_v_d_meer@gmail.com','Amsterdam'),
        ('Paul','de Jong',4,'QA Manager','IT','020-000-0006','06-67800468','pdejong@gmail.com','Den Haag'),
        ('Karel','Leemhuis',1,'Directeur','Accounting','020-000-0003','020-000-0003','k.leemhuis@gmail.com','Den Helder'),
        ('Jan','Willems',1,'E-commerce specialist','IT','020-5389263','06-0000004','j_willems@gmail.com','Den Haag'),
        ('Jaques','Tallin',1,'Manager','Marketing','020-000-0002','06-0000002','j.tallin@gmail.com','Amstelveen'),
        ('Jan','van de Meer',0,'Tester','IT','020-000-0001','06-0000001','j.vd.meer@gmail.com','Amsterdam');
UNLOCK TABLES;