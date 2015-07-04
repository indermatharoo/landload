ALTER TABLE `dpd_enquiry`  ADD `event_related` TINYINT(1) NOT NULL DEFAULT '0' ,
    ADD `event_id` INT NOT NULL DEFAULT '0' ,  ADD `event_creator_id` INT NOT NULL DEFAULT '0' ;

ALTER TABLE `dpd_enquiry` ADD `enq_creator_id` INT NOT NULL DEFAULT '0' AFTER `id`;
truncate `dpd_enquiry`;
truncate `dpd_enquiry_followup`;