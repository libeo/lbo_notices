#
# Table structure for table 'tx_lbonotices_domain_model_notice'
#
CREATE TABLE tx_lbonotices_domain_model_notice (

	title varchar(255) DEFAULT '' NOT NULL,
	slug varchar(2048),
	teaser text,
	description text,
	level int(11) DEFAULT '0' NOT NULL

);
