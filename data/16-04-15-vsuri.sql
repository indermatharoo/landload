-- Table created for virtual cab
drop table dpd_virtualCab;
CREATE TABLE `dpd_virtualCab` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary',
 `visible_name` varchar(100) NOT NULL COMMENT 'Generated Name',
 `filetype` varchar(50) NOT NULL COMMENT 'Type',
 `actual_name` varchar(255) NOT NULL COMMENT 'Actual Name',
 `creator_id` int(11) unsigned NOT NULL COMMENT 'Creator Reference',
 `assigne_grp` int(2) NOT NULL DEFAULT '0',
 `assignes` text NOT NULL,
 `create_dtime` datetime NOT NULL COMMENT 'create date time',
 `update_dtime` datetime NOT NULL COMMENT 'update date time',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

