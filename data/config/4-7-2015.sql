alter table dpd_customer change customer_id customer_id int(10) unsigned auto_increment primary key;
alter table dpd_customer drop user_id;