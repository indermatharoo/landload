drop trigger if exists updateForumActivity
drop table if exists dpd_user_notification;
CREATE TABLE `dpd_user_notification` (
 `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
 `creator_id` int(11) NOT NULL DEFAULT '0',
 `user_id` int(11) unsigned NOT NULL COMMENT 'user id reference',
 `read` tinyint(1) NOT NULL DEFAULT '0',
 `source_class` varchar(255) NOT NULL DEFAULT ' ' COMMENT 'Called class',
 `source_action` varchar(255) NOT NULL DEFAULT ' ' COMMENT 'Called function',
 `user_ip` varchar(20) DEFAULT NULL COMMENT 'User IP at that time',
 `activity_time` int(11) DEFAULT NULL COMMENT 'User activity time',
 `extra_values` varchar(255) NOT NULL DEFAULT ' ',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1