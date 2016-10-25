DROP TABLE IF EXISTS `#__tc_content`;

DELETE FROM `#__content_types` WHERE (type_alias LIKE 'com_tc.%');