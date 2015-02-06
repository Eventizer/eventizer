ALTER TABLE  `lh_users` ADD  `org_name` VARCHAR( 255 ) NOT NULL AFTER  `system` ,
ADD  `org_description` VARCHAR( 255 ) NOT NULL AFTER  `org_name` ,
ADD  `org_www` VARCHAR( 255 ) NOT NULL AFTER  `org_description` ,
ADD  `org_fb` VARCHAR( 255 ) NOT NULL AFTER  `org_www` ,
ADD  `org_tw` VARCHAR( 255 ) NOT NULL AFTER  `org_fb`;

ALTER TABLE  `lh_events` ADD  `org_id` INT( 11 ) NOT NULL AFTER  `cat_id`;
ALTER TABLE  `lh_users` ADD  `file_name` VARCHAR( 255 ) NOT NULL AFTER  `created` ,
ADD  `file` VARCHAR( 255 ) NOT NULL AFTER  `file_name`;
ALTER TABLE  `lh_users` ADD  `variations` TEXT NOT NULL AFTER  `file`;

INSERT INTO `dev_eventizer`.`lh_system_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('facebook_app_id', '', '0', 'Facebook API ID for facebook applications', '0');
INSERT INTO `dev_eventizer`.`lh_system_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('twitter_app_id', '', '0', 'Twitter API ID for twitter applications', '0');