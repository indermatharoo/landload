ALTER TABLE `dpd_eventbooking_venues` ADD `user_id` INT(11) NOT NULL ;
ALTER TABLE `dpd_aauth_users` CHANGE `NickName` `NickName` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `dpd_aauth_users` CHANGE `Avatar` `Avatar` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `dpd_aauth_users` ADD `pic` VARCHAR(255) NULL ;
