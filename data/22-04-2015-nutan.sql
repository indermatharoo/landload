ALTER TABLE `dpd_eventbooking_events` DROP `category_id`;
ALTER TABLE `dpd_eventbooking_event_type` ADD `event_color` VARCHAR(255) NOT NULL AFTER `event_type`;
ALTER TABLE `dpd_eventbooking_bookings` CHANGE `id` `booking_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;