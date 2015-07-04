drop table IF EXISTS dpd_enquiry;
CREATE TABLE `dpd_enquiry` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `first_name` varchar(100) NOT NULL DEFAULT ' ' COMMENT 'First Name',
 `last_name` varchar(100) NOT NULL DEFAULT ' ' COMMENT 'Last Name',
 `tel_number` varchar(15) NOT NULL DEFAULT ' ' COMMENT 'Telephone Number',
 `email_addr` varchar(100) NOT NULL DEFAULT ' ' COMMENT 'Email Addr',
 `post_code` varchar(20) NOT NULL DEFAULT ' ' COMMENT 'Post code',
 `enq_reason` int(2) NOT NULL DEFAULT '0' COMMENT 'Enq Id',
 `receive_update_news` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'News And updates',
 `how_reach` varchar(255) NOT NULL DEFAULT ' ',
 `enquiry` varchar(1000) NOT NULL DEFAULT ' ',
 `souceSiteUser` enum('1','2','3','4') NOT NULL DEFAULT '1' COMMENT '1 => site, 2=> admin, 3=> ?, 4 => ?',
 `status` enum('1','2','3','4','5') NOT NULL DEFAULT '1' COMMENT '1 => enquiry, 2=> under_process, 3 => pending, 4 => forward, 5=> finish',
 `next_follow_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
 `active` tinyint(1) NOT NULL DEFAULT '1',
 `insert_time` datetime NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='Save Any Enquiry';

drop table IF EXISTS dpd_enquiry_followup;
CREATE TABLE `dpd_enquiry_followup` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `enquiry_id` int(11) unsigned NOT NULL DEFAULT '0',
 `followup_dtime` datetime NOT NULL,
 `follow_way` varchar(100) DEFAULT NULL,
 `description` varchar(1000) DEFAULT NULL,
 `next_follow_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
 `enq_status` enum('1','2','3','4','5') NOT NULL DEFAULT '1' COMMENT '1 => enquiry, 2=> under_process, 3 => pending, 4 => forward, 5=> finish',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

drop table IF EXISTS dpd_enquiry_types;
CREATE TABLE `dpd_enquiry_types` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `desc` varchar(255) NOT NULL,
 `sort_order` int(2) NOT NULL DEFAULT '0',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1
