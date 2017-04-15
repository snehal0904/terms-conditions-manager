CREATE TABLE IF NOT EXISTS `#__tc_content` (
`tc_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
`title` VARCHAR(255)  NOT NULL ,
`version` FLOAT NOT NULL,
`client` VARCHAR(255)  NOT NULL ,
`start_date` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`content` TEXT NOT NULL ,
`global` TINYINT(1)  NOT NULL ,
`groups` VARCHAR(255)  NOT NULL ,
`is_blacklist` TINYINT(1)  NOT NULL ,
`created_on` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`modified_on` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
PRIMARY KEY (`tc_id`),
UNIQUE KEY `client_version` (`client`,`version`)
) Engine=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__tc_patterns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tc_id` int(11) NOT NULL,
  `client` VARCHAR(255) NOT NULL,
  `option` VARCHAR(255) NOT NULL,
  `view` VARCHAR(255) NOT NULL,
  `params` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) Engine=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__tc_acceptance` (
  `tc_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `client` varchar(250) NOT NULL,
  `accepted_date` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `params` varchar(250) NOT NULL,
  UNIQUE KEY `user_tc` (`user_id`,`tc_id`)
) Engine=InnoDB DEFAULT CHARSET=utf8;
