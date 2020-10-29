
DROP TABLE IF EXISTS `academy`; 


CREATE TABLE `academy` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` varchar(300) NOT NULL,
  `details` varchar(300) NOT NULL,
  `principle` varchar(300) NOT NULL,
  `logo` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


 INSERT INTO academy (`id`,`name`,`contact`,`address`,`details`,`principle`,`logo`,`created_at`,`updated_at`) VALUES ('1','The Learning Academy','02 -2030120','Floor 321, Main Street, West road','This is a Academy with well furnished equipment & highly qualified faculty providing quality education with the mission to let you shine your future','corona.jpeg','abc.png','2020-06-12 16:55:17','2020-10-26 11:46:35');

DROP TABLE IF EXISTS `assign_fee`; 


CREATE TABLE `assign_fee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_group_id` varchar(50) NOT NULL,
  `fee_type_id` varchar(50) NOT NULL,
  `date` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;


 INSERT INTO assign_fee (`id`,`fee_group_id`,`fee_type_id`,`date`,`amount`,`created_at`,`updated_at`) VALUES ('68','13','11','2020-03-04','1500','2020-05-14 01:23:11','2020-05-13 15:23:11');

 INSERT INTO assign_fee (`id`,`fee_group_id`,`fee_type_id`,`date`,`amount`,`created_at`,`updated_at`) VALUES ('69','13','12','2020-02-05','1000','2020-05-14 01:24:14','2020-05-13 15:24:14');

 INSERT INTO assign_fee (`id`,`fee_group_id`,`fee_type_id`,`date`,`amount`,`created_at`,`updated_at`) VALUES ('71','14','12','2020-04-07','3000','2020-05-14 01:28:22','2020-05-13 15:28:22');

 INSERT INTO assign_fee (`id`,`fee_group_id`,`fee_type_id`,`date`,`amount`,`created_at`,`updated_at`) VALUES ('72','14','13','2020-03-11','1200','2020-05-14 01:28:53','2020-05-13 15:28:53');

 INSERT INTO assign_fee (`id`,`fee_group_id`,`fee_type_id`,`date`,`amount`,`created_at`,`updated_at`) VALUES ('73','16','12','2020-02-05','2000','2020-05-16 01:02:02','2020-05-15 15:02:02');

 INSERT INTO assign_fee (`id`,`fee_group_id`,`fee_type_id`,`date`,`amount`,`created_at`,`updated_at`) VALUES ('76','14','11','2020-07-28','1000','2020-07-01 14:21:50','2020-07-01 04:21:50');

 INSERT INTO assign_fee (`id`,`fee_group_id`,`fee_type_id`,`date`,`amount`,`created_at`,`updated_at`) VALUES ('77','14','14','2020-07-29','1000','2020-07-01 14:24:28','2020-07-01 04:24:28');

 INSERT INTO assign_fee (`id`,`fee_group_id`,`fee_type_id`,`date`,`amount`,`created_at`,`updated_at`) VALUES ('79','19','12','2020-07-08','1000','2020-07-27 07:43:47','2020-07-26 21:43:47');

DROP TABLE IF EXISTS `attendence_type`; 


CREATE TABLE `attendence_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) DEFAULT NULL,
  `key_value` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;


 INSERT INTO attendence_type (`id`,`type`,`key_value`,`created_at`,`updated_at`) VALUES ('1','Present','<b class="text text-success">P</b>','2020-06-30 18:38:59','2020-06-30 18:38:59');

 INSERT INTO attendence_type (`id`,`type`,`key_value`,`created_at`,`updated_at`) VALUES ('2','Late','<b class="text text-warning">L</b>','2020-06-30 18:38:59','2020-06-30 18:38:59');

 INSERT INTO attendence_type (`id`,`type`,`key_value`,`created_at`,`updated_at`) VALUES ('3','Absent','<b class="text text-danger">A</b>','2020-06-30 18:40:13','2020-06-30 18:40:13');

 INSERT INTO attendence_type (`id`,`type`,`key_value`,`created_at`,`updated_at`) VALUES ('4','Holiday','H','2020-06-30 18:40:13','2020-06-30 18:40:13');

 INSERT INTO attendence_type (`id`,`type`,`key_value`,`created_at`,`updated_at`) VALUES ('5','Half Day','<b class="text text-warning">F</b>','2020-06-30 18:41:07','2020-06-30 18:41:07');

DROP TABLE IF EXISTS `backups`; 


CREATE TABLE `backups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `src` varchar(100) DEFAULT NULL,
  `created_by` varchar(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;


 INSERT INTO backups (`id`,`src`,`created_by`,`created_at`,`updated_at`) VALUES ('37','D:Xampphtdocsxplode-techackups/DATABASE_xplode-tech_10-26-2020.sql','super_admin','2020-10-26 11:32:10','2020-10-26 02:32:11');

 INSERT INTO backups (`id`,`src`,`created_by`,`created_at`,`updated_at`) VALUES ('38','D:\Xampp\htdocs\xplode-tech\backups/DATABASE_xplode-tech_10-26-2020.sql','admin','2020-10-26 11:42:22','2020-10-26 02:42:22');

DROP TABLE IF EXISTS `courses`; 


CREATE TABLE `courses` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `code` varchar(20) NOT NULL,
  `years` int(5) DEFAULT 0,
  `months` int(5) DEFAULT 0,
  `weeks` int(5) DEFAULT 0,
  `fee` float DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;


 INSERT INTO courses (`id`,`name`,`code`,`years`,`months`,`weeks`,`fee`,`created_at`,`updated_at`) VALUES ('2','Graphics Deisigning','107','0','0','0','1500','2020-04-22 02:18:33','2020-07-25 15:01:14');

 INSERT INTO courses (`id`,`name`,`code`,`years`,`months`,`weeks`,`fee`,`created_at`,`updated_at`) VALUES ('14','Covid-19','009','1','0','0','3000','2020-04-28 08:32:07','2020-04-29 02:01:18');

 INSERT INTO courses (`id`,`name`,`code`,`years`,`months`,`weeks`,`fee`,`created_at`,`updated_at`) VALUES ('15','Web Engineering ','102','1','0','0','1500','2020-05-07 08:58:35','2020-05-14 01:40:17');

 INSERT INTO courses (`id`,`name`,`code`,`years`,`months`,`weeks`,`fee`,`created_at`,`updated_at`) VALUES ('67','Ms Office','003','0','3','0','1000','2020-07-03 14:10:34','2020-07-03 04:10:34');

DROP TABLE IF EXISTS `expenses`; 


CREATE TABLE `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `amount` float NOT NULL,
  `date` date NOT NULL,
  `description` varchar(300) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;


 INSERT INTO expenses (`id`,`title`,`amount`,`date`,`description`,`status`,`created_at`,`updated_at`) VALUES ('13','Electricity bill','26000','2020-10-06','DOne','primary','2020-06-10 04:42:05','2020-06-09 18:42:05');

 INSERT INTO expenses (`id`,`title`,`amount`,`date`,`description`,`status`,`created_at`,`updated_at`) VALUES ('14','Tea','1000','2020-03-11','Done','temporary','2020-06-10 04:43:46','2020-06-09 18:43:46');

 INSERT INTO expenses (`id`,`title`,`amount`,`date`,`description`,`status`,`created_at`,`updated_at`) VALUES ('16','Gas Bill','10000','2020-01-07','Done','primary','2020-10-27 14:41:49','2020-10-27 14:59:16');

 INSERT INTO expenses (`id`,`title`,`amount`,`date`,`description`,`status`,`created_at`,`updated_at`) VALUES ('17','Electricity bill','6000','2020-02-11','Done','primary','2020-10-27 14:42:27','2020-10-27 05:42:27');

 INSERT INTO expenses (`id`,`title`,`amount`,`date`,`description`,`status`,`created_at`,`updated_at`) VALUES ('18','Electricity bill','117000','2020-03-17','Done','primary','2020-10-27 14:43:29','2020-10-27 05:43:29');

 INSERT INTO expenses (`id`,`title`,`amount`,`date`,`description`,`status`,`created_at`,`updated_at`) VALUES ('20','Electricity bill','45000','2020-06-06','DOne','primary','2020-10-27 14:45:28','2020-10-27 05:45:28');

 INSERT INTO expenses (`id`,`title`,`amount`,`date`,`description`,`status`,`created_at`,`updated_at`) VALUES ('21','Gas Bill','1000','2020-07-08','DOne','primary','2020-10-27 14:45:59','2020-10-27 05:45:59');

 INSERT INTO expenses (`id`,`title`,`amount`,`date`,`description`,`status`,`created_at`,`updated_at`) VALUES ('22','Electricity Bill','30000','2020-10-09','Done','primary','2020-10-27 14:47:09','2020-10-27 05:47:09');

DROP TABLE IF EXISTS `fee_groups`; 


CREATE TABLE `fee_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_group` varchar(50) NOT NULL,
  `description` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;


 INSERT INTO fee_groups (`id`,`fee_group`,`description`,`created_at`,`updated_at`) VALUES ('13','DIT','','2020-05-05 05:59:51','2020-05-09 01:47:34');

 INSERT INTO fee_groups (`id`,`fee_group`,`description`,`created_at`,`updated_at`) VALUES ('14','CIT','','2020-05-07 12:28:51','2020-05-09 01:47:24');

 INSERT INTO fee_groups (`id`,`fee_group`,`description`,`created_at`,`updated_at`) VALUES ('15','One','Done','2020-05-08 02:02:27','2020-05-07 16:02:27');

 INSERT INTO fee_groups (`id`,`fee_group`,`description`,`created_at`,`updated_at`) VALUES ('19','January ','','2020-07-25 20:20:22','2020-07-25 20:21:02');

DROP TABLE IF EXISTS `fee_types`; 


CREATE TABLE `fee_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_type` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL,
  `description` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;


 INSERT INTO fee_types (`id`,`fee_type`,`code`,`description`,`created_at`,`updated_at`) VALUES ('11','Picnic','110','','2020-05-05 02:13:26','2020-07-29 13:34:44');

 INSERT INTO fee_types (`id`,`fee_type`,`code`,`description`,`created_at`,`updated_at`) VALUES ('12','February ','110','Done','2020-05-06 01:58:50','2020-05-05 15:58:50');

 INSERT INTO fee_types (`id`,`fee_type`,`code`,`description`,`created_at`,`updated_at`) VALUES ('13','January ','101','Done
','2020-05-08 02:28:37','2020-05-07 16:28:37');

 INSERT INTO fee_types (`id`,`fee_type`,`code`,`description`,`created_at`,`updated_at`) VALUES ('14','March','102','Done','2020-05-08 02:28:49','2020-05-07 16:28:49');

DROP TABLE IF EXISTS `master`; 


CREATE TABLE `master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_type_id` varchar(50) NOT NULL,
  `fee_group_id` varchar(50) NOT NULL,
  `student_id` varchar(100) NOT NULL,
  `amount` float NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Unpaid',
  `payment` varchar(300) NOT NULL,
  `due_date` date DEFAULT NULL,
  `paid` float NOT NULL,
  `fine` float NOT NULL,
  `discount` float NOT NULL,
  `balance` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=188 DEFAULT CHARSET=latin1;


 INSERT INTO master (`id`,`fee_type_id`,`fee_group_id`,`student_id`,`amount`,`status`,`payment`,`due_date`,`paid`,`fine`,`discount`,`balance`,`created_at`,`updated_at`) VALUES ('180','11','13','35','1500','advance','','0000-00-00','21800','2000','900','-20300','2020-07-03 03:00:21','2020-07-02 17:00:21');

 INSERT INTO master (`id`,`fee_type_id`,`fee_group_id`,`student_id`,`amount`,`status`,`payment`,`due_date`,`paid`,`fine`,`discount`,`balance`,`created_at`,`updated_at`) VALUES ('181','12','13','35','1000','advance','','0000-00-00','1300','0','300','-300','2020-07-03 03:00:21','2020-07-02 17:00:21');

 INSERT INTO master (`id`,`fee_type_id`,`fee_group_id`,`student_id`,`amount`,`status`,`payment`,`due_date`,`paid`,`fine`,`discount`,`balance`,`created_at`,`updated_at`) VALUES ('182','12','19','48','1000','advance','','0000-00-00','10000','0','0','-9000','2020-07-27 07:44:09','2020-07-26 21:44:09');

 INSERT INTO master (`id`,`fee_type_id`,`fee_group_id`,`student_id`,`amount`,`status`,`payment`,`due_date`,`paid`,`fine`,`discount`,`balance`,`created_at`,`updated_at`) VALUES ('183','12','19','45','1000','paid','','0000-00-00','1000','12','0','0','2020-09-28 20:29:09','2020-09-28 10:29:09');

 INSERT INTO master (`id`,`fee_type_id`,`fee_group_id`,`student_id`,`amount`,`status`,`payment`,`due_date`,`paid`,`fine`,`discount`,`balance`,`created_at`,`updated_at`) VALUES ('184','12','14','68','3000','partial','','','1000','0','0','2000','2020-10-27 16:52:19','2020-10-27 07:52:19');

 INSERT INTO master (`id`,`fee_type_id`,`fee_group_id`,`student_id`,`amount`,`status`,`payment`,`due_date`,`paid`,`fine`,`discount`,`balance`,`created_at`,`updated_at`) VALUES ('185','13','14','68','1200','Unpaid','','','0','0','0','1200','2020-10-27 16:52:19','2020-10-27 07:52:19');

 INSERT INTO master (`id`,`fee_type_id`,`fee_group_id`,`student_id`,`amount`,`status`,`payment`,`due_date`,`paid`,`fine`,`discount`,`balance`,`created_at`,`updated_at`) VALUES ('186','11','14','68','1000','Unpaid','','','0','0','0','1000','2020-10-27 16:52:19','2020-10-27 07:52:19');

 INSERT INTO master (`id`,`fee_type_id`,`fee_group_id`,`student_id`,`amount`,`status`,`payment`,`due_date`,`paid`,`fine`,`discount`,`balance`,`created_at`,`updated_at`) VALUES ('187','14','14','68','1000','Unpaid','','','0','0','0','1000','2020-10-27 16:52:19','2020-10-27 07:52:19');

DROP TABLE IF EXISTS `migrations`; 


CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` text NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;


 INSERT INTO migrations (`id`,`version`,`class`,`group`,`namespace`,`time`,`batch`) VALUES ('2','2020-04-16-121151','AppDatabaseMigrationsCreateUsersTable','default','App','1587106864','1');

 INSERT INTO migrations (`id`,`version`,`class`,`group`,`namespace`,`time`,`batch`) VALUES ('3','2020-04-20-115858','AppDatabaseMigrationsCreateCoursesTable','default','App','1587384530','2');

 INSERT INTO migrations (`id`,`version`,`class`,`group`,`namespace`,`time`,`batch`) VALUES ('4','2020-04-21-114018','AppDatabaseMigrationsCreateCoursesTable','default','App','1587469285','3');

DROP TABLE IF EXISTS `payment`; 


CREATE TABLE `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_group_id` varchar(50) NOT NULL,
  `fee_type_id` varchar(50) NOT NULL,
  `student_id` varchar(100) NOT NULL,
  `payment_id` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `paid` float NOT NULL,
  `fine` float NOT NULL,
  `discount` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=latin1;


 INSERT INTO payment (`id`,`fee_group_id`,`fee_type_id`,`student_id`,`payment_id`,`date`,`paid`,`fine`,`discount`,`created_at`,`updated_at`) VALUES ('211','13','11','35','1','2020-10-25','800','0','300','2020-07-03 03:00:56','2020-07-02 17:00:56');

 INSERT INTO payment (`id`,`fee_group_id`,`fee_type_id`,`student_id`,`payment_id`,`date`,`paid`,`fine`,`discount`,`created_at`,`updated_at`) VALUES ('212','13','11','35','2','2020-10-22','100','0','300','2020-07-03 03:01:33','2020-07-02 17:01:33');

 INSERT INTO payment (`id`,`fee_group_id`,`fee_type_id`,`student_id`,`payment_id`,`date`,`paid`,`fine`,`discount`,`created_at`,`updated_at`) VALUES ('213','13','12','35','1','2020-10-18','1000','0','300','2020-07-27 07:51:24','2020-07-26 21:51:24');

 INSERT INTO payment (`id`,`fee_group_id`,`fee_type_id`,`student_id`,`payment_id`,`date`,`paid`,`fine`,`discount`,`created_at`,`updated_at`) VALUES ('214','13','11','35','3','2020-09-15','20000','2000','300','2020-10-27 09:02:14','2020-10-27 00:02:14');

 INSERT INTO payment (`id`,`fee_group_id`,`fee_type_id`,`student_id`,`payment_id`,`date`,`paid`,`fine`,`discount`,`created_at`,`updated_at`) VALUES ('216','19','12','48','2','2020-09-02','4000','0','0','2020-10-27 09:04:00','2020-10-27 00:04:00');

 INSERT INTO payment (`id`,`fee_group_id`,`fee_type_id`,`student_id`,`payment_id`,`date`,`paid`,`fine`,`discount`,`created_at`,`updated_at`) VALUES ('217','19','12','48','2','2020-10-06','6000','0','0','2020-10-27 09:05:13','2020-10-27 00:05:13');

 INSERT INTO payment (`id`,`fee_group_id`,`fee_type_id`,`student_id`,`payment_id`,`date`,`paid`,`fine`,`discount`,`created_at`,`updated_at`) VALUES ('218','19','12','45','1','2020-08-04','1000','12','0','2020-10-27 09:06:45','2020-10-27 00:06:45');

 INSERT INTO payment (`id`,`fee_group_id`,`fee_type_id`,`student_id`,`payment_id`,`date`,`paid`,`fine`,`discount`,`created_at`,`updated_at`) VALUES ('219','14','12','68','1','2020-10-02','1000','0','0','2020-10-27 16:53:03','2020-10-27 07:53:03');

DROP TABLE IF EXISTS `sms_creadentials`; 


CREATE TABLE `sms_creadentials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `sender` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


 INSERT INTO sms_creadentials (`id`,`username`,`password`,`sender`) VALUES ('1','923002687756','iunc@123','The Learning Academy');

DROP TABLE IF EXISTS `student_attendences`; 


CREATE TABLE `student_attendences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `attendence_type_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=348 DEFAULT CHARSET=latin1;


 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('243','35','2','2020-07-01','1','2020-08-26 13:13:38','2020-09-26 21:32:50');

 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('244','40','2','2020-07-01','1','2020-08-26 13:13:38','2020-09-26 21:32:50');

 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('245','68','2','2020-07-01','2','2020-08-26 13:13:38','2020-09-26 21:32:50');

 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('246','35','2','2020-07-07','1','2020-08-26 13:14:21','2020-08-26 13:14:33');

 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('247','40','2','2020-07-07','2','2020-08-26 13:14:21','2020-08-26 13:14:33');

 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('248','68','2','2020-07-07','2','2020-08-26 13:14:21','2020-08-26 13:14:33');

 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('249','35','2','2020-07-15','5','2020-08-26 13:14:45','2020-08-26 03:14:45');

 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('250','40','2','2020-07-15','5','2020-08-26 13:14:45','2020-08-26 03:14:45');

 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('251','68','2','2020-07-15','5','2020-08-26 13:14:45','2020-08-26 03:14:45');

 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('254','48','14','2020-08-01','5','2020-08-26 13:16:51','2020-08-26 03:16:51');

 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('255','49','14','2020-08-01','5','2020-08-26 13:16:51','2020-08-26 03:16:51');

 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('256','48','14','2020-08-02','5','2020-08-26 13:17:03','2020-08-26 03:17:03');

 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('257','49','14','2020-08-02','5','2020-08-26 13:17:03','2020-08-26 03:17:03');

 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('258','48','14','2020-08-06','5','2020-08-26 13:17:49','2020-08-26 03:17:49');

 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('259','49','14','2020-08-06','5','2020-08-26 13:17:49','2020-08-26 03:17:49');

 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('260','48','14','2020-08-17','1','2020-08-26 13:18:21','2020-08-26 13:18:31');

 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('261','49','14','2020-08-17','2','2020-08-26 13:18:21','2020-08-26 13:18:31');

 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('262','48','14','2020-08-18','1','2020-08-26 13:18:42','2020-08-26 13:18:54');

 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('263','49','14','2020-08-18','1','2020-08-26 13:18:42','2020-08-26 13:18:54');

 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('264','48','14','2020-08-19','2','2020-08-26 13:19:05','2020-08-26 13:19:17');

 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('265','49','14','2020-08-19','2','2020-08-26 13:19:05','2020-08-26 13:19:17');

 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('339','35','2','2008-03-17','1','2020-08-31 09:11:33','2020-08-31 09:11:40');

 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('340','40','2','2008-03-17','1','2020-08-31 09:11:33','2020-08-31 09:11:40');

 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('341','68','2','2008-03-17','2','2020-08-31 09:11:33','2020-08-31 09:11:40');

 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('342','35','2','2020-10-08','','2020-10-27 14:51:05','2020-10-27 05:51:05');

 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('343','40','2','2020-10-08','','2020-10-27 14:51:05','2020-10-27 05:51:05');

 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('344','68','2','2020-10-08','','2020-10-27 14:51:05','2020-10-27 05:51:05');

 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('345','35','2','2020-10-27','5','2020-10-27 16:55:18','2020-10-27 16:55:30');

 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('346','40','2','2020-10-27','5','2020-10-27 16:55:18','2020-10-27 16:55:30');

 INSERT INTO student_attendences (`id`,`student_id`,`course_id`,`date`,`attendence_type_id`,`created_at`,`updated_at`) VALUES ('347','68','2','2020-10-27','5','2020-10-27 16:55:18','2020-10-27 07:55:18');

DROP TABLE IF EXISTS `students`; 


CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admission_no` varchar(100) DEFAULT NULL,
  `sname` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `fphone` varchar(100) NOT NULL,
  `address` varchar(300) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `gander` varchar(100) NOT NULL,
  `cnic` varchar(100) NOT NULL,
  `fcnic` varchar(100) NOT NULL,
  `course_id` varchar(100) NOT NULL,
  `fee_amount` varchar(100) NOT NULL,
  `discount` varchar(100) NOT NULL,
  `sourse` varchar(300) NOT NULL,
  `refrence` varchar(300) NOT NULL,
  `education` varchar(300) NOT NULL,
  `school` varchar(300) NOT NULL,
  `previous` varchar(300) NOT NULL,
  `image` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;


 INSERT INTO students (`id`,`admission_no`,`sname`,`fname`,`phone`,`fphone`,`address`,`dob`,`gander`,`cnic`,`fcnic`,`course_id`,`fee_amount`,`discount`,`sourse`,`refrence`,`education`,`school`,`previous`,`image`,`created_at`,`updated_at`) VALUES ('35','0470','Aman Ullah','Wajahat Khan','03129403210','03162250578','Nazimabad','2020-06-03','Male','42401-930221-1','2020-06-02','2','1500','300','Friend','Card','Metric','Muslim public','Ms Office','boy-04.jpg','2020-04-29 02:43:50','2020-09-28 19:29:26');

 INSERT INTO students (`id`,`admission_no`,`sname`,`fname`,`phone`,`fphone`,`address`,`dob`,`gander`,`cnic`,`fcnic`,`course_id`,`fee_amount`,`discount`,`sourse`,`refrence`,`education`,`school`,`previous`,`image`,`created_at`,`updated_at`) VALUES ('40','0471','Muhammad Siyab','Farman Khan','03122598041','03122597292','Orangi Town','2020-06-10','Male','42401-293443-1','2020-06-19','2','1500','500','Friend','No','Intermediate  ','The Smart School','Ms Office','abc.jpg','2020-05-07 09:32:29','2020-09-26 18:12:06');

 INSERT INTO students (`id`,`admission_no`,`sname`,`fname`,`phone`,`fphone`,`address`,`dob`,`gander`,`cnic`,`fcnic`,`course_id`,`fee_amount`,`discount`,`sourse`,`refrence`,`education`,`school`,`previous`,`image`,`created_at`,`updated_at`) VALUES ('45','0472','Iqra Alam','Saeed Alam ','03120302011','03459403332','Nazimabad','2000-07-05','Female','42401-29304-2','2020-07-09','15','1500','500','Friend','Card','Intermediate ','The Smart School','Ms Office','girl.jpg','2020-05-09 03:28:01','2020-09-10 07:33:12');

 INSERT INTO students (`id`,`admission_no`,`sname`,`fname`,`phone`,`fphone`,`address`,`dob`,`gander`,`cnic`,`fcnic`,`course_id`,`fee_amount`,`discount`,`sourse`,`refrence`,`education`,`school`,`previous`,`image`,`created_at`,`updated_at`) VALUES ('48','0521','Wajahat','Waseem ','03450431203','03002404532','Orangi Town','2001-06-06','Male','42401-405055-1','2020-01-15','14','3000','200','Friend ','Card','Metric ','The Smart School','Ms Office','20170903113336_IMG_6560.JPG','2020-05-19 03:06:20','2020-09-07 19:56:19');

 INSERT INTO students (`id`,`admission_no`,`sname`,`fname`,`phone`,`fphone`,`address`,`dob`,`gander`,`cnic`,`fcnic`,`course_id`,`fee_amount`,`discount`,`sourse`,`refrence`,`education`,`school`,`previous`,`image`,`created_at`,`updated_at`) VALUES ('49','0478','Asim Azar ','Azar Mahmood  ','03129384021','03440394044','Clifton ','2000-06-21','Male','42401-949494-1','2020-07-16','14','3000','100','Friend','Card','Nine','The Smart School','None','kids-1508121_1280.jpg','2020-05-22 01:50:43','2020-09-07 21:01:21');

 INSERT INTO students (`id`,`admission_no`,`sname`,`fname`,`phone`,`fphone`,`address`,`dob`,`gander`,`cnic`,`fcnic`,`course_id`,`fee_amount`,`discount`,`sourse`,`refrence`,`education`,`school`,`previous`,`image`,`created_at`,`updated_at`) VALUES ('68','0540','Salman Khan','Wajahat Khan','031293302','03062862559','Orangi town','2020-05-11','Male','42401-394900-1','2020-07-02','2','1500','0','None','None','metric','Mumtaz ','None','6d3671c5d44e7361651a01e4c36b8d5f.jpg','2020-07-07 17:16:48','2020-09-28 19:57:55');

 INSERT INTO students (`id`,`admission_no`,`sname`,`fname`,`phone`,`fphone`,`address`,`dob`,`gander`,`cnic`,`fcnic`,`course_id`,`fee_amount`,`discount`,`sourse`,`refrence`,`education`,`school`,`previous`,`image`,`created_at`,`updated_at`) VALUES ('74','0480','Mudasir Khan','Saeed Ullah','03120939021','03450990332','Orangi Town','2002-02-07','Male','42401-3930-1','2020-08-12','67','1000','None','Card','None','Metric','The Smart School','None','images.jpg','2020-09-10 13:27:09','2020-09-11 07:38:25');

DROP TABLE IF EXISTS `users`; 


CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;


 INSERT INTO users (`id`,`username`,`email`,`password`,`role`,`created_at`,`updated_at`) VALUES ('7','user','user@gmail.com','$2y$10$iIAJtcSrcYQXb7o6hqQVEObuKVpVBEG9hmNlhJlqaxGrRWADKg23y','admin','2020-10-14 21:28:44','2020-10-25 18:21:31');

 INSERT INTO users (`id`,`username`,`email`,`password`,`role`,`created_at`,`updated_at`) VALUES ('8','admim','admin@gmail.com','$2y$10$xZhJEGXZoIr4Ljx4LNrneeqSAQmyfDVzYgJGCH0swmHU//t3J/wK6','super_admin','2020-10-14 11:29:23','2020-10-25 17:13:37');
