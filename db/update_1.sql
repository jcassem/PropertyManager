/*
- Create address table
- Create property table
- Create person table
*/

INSERT INTO version (version_number, description) VALUES ('update_1', 'Create address, property and person tables');

CREATE TABLE address (
	address_id   INT         NOT NULL AUTO_INCREMENT,
	house_number VARCHAR(16) NOT NULL,
	street_name  VARCHAR(32),
	second_line  VARCHAR(32),
	city         VARCHAR(20),
	county       VARCHAR(20),
	postcode     VARCHAR(10) NOT NULL,
	PRIMARY KEY (address_id)
)
	ENGINE MyISAM;

CREATE TABLE person (
	person_id     INT         NOT NULL AUTO_INCREMENT,
	type          ENUM('TENANT', 'LANDLORD', 'AGENT', 'CONTRACTOR', 'OTHER'),
	first_name    VARCHAR(32) NOT NULL,
	second_name   VARCHAR(32),
	salutation ENUM('Mr', 'Mrs', 'Miss', 'Ms', 'Dr', 'Lord') NOT NULL DEFAULT 'Mr',
	company_name  VARCHAR(64),
	email_address VARCHAR(64),
	mobile_number VARCHAR(20),
	notes         VARCHAR(200),
	PRIMARY KEY (person_id)
)
	ENGINE MyISAM;

CREATE TABLE property (
	property_id INT NOT NULL AUTO_INCREMENT,
	address_id  INT NOT NULL,
	landlord_id INT NOT NULL,
	key_number  VARCHAR(16),
	notes       VARCHAR(200),
	PRIMARY KEY (property_id),
	FOREIGN KEY (address_id) REFERENCES address (address_id),
	FOREIGN KEY (landlord_id) REFERENCES person (person_id)
)
	ENGINE MyISAM;

COMMIT;