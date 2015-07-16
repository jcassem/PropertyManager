/*
- Create deposit protection schemes table
- Create deposit table
- Create tenancy types table
- Create tenancy table
- Create tenant-tenancy mapping table
*/

INSERT INTO version (version_number, description) VALUES ('update_2', 'Create deposit and tenancy tables');

CREATE TABLE deposit_protection_schemes (
	deposit_type VARCHAR(32) UNIQUE,
	description  VARCHAR(200),
	PRIMARY KEY (deposit_type)
)
	ENGINE MyISAM;

CREATE TABLE deposit (
	deposit_id        INT            NOT NULL AUTO_INCREMENT,
	amount            NUMERIC(15, 2) NOT NULL,
	date_received     DATE,
	date_returned     DATE,
	protection_scheme VARCHAR(32),
	PRIMARY KEY (deposit_id),
	FOREIGN KEY (protection_scheme) REFERENCES deposit_protection_schemes (deposit_type)
)
	ENGINE MyISAM;

CREATE TABLE tenancy_types (
	tenancy_type VARCHAR(32) UNIQUE,
	description  VARCHAR(200),
	PRIMARY KEY (tenancy_type)
)
	ENGINE MyISAM;

CREATE TABLE tenancy (
	tenancy_id   INT            NOT NULL AUTO_INCREMENT,
	property_id  INT            NOT NULL,
	start_date   DATE           NOT NULL,
	expiry_date  DATE           NOT NULL,
	monthly_rent NUMERIC(15, 2) NOT NULL,
	tenancy_type VARCHAR(32)    NOT NULL,
	deposit_id   INT,
	notes        VARCHAR(200),
	PRIMARY KEY (tenancy_id),
	FOREIGN KEY (property_id) REFERENCES property (property_id),
	FOREIGN KEY (tenancy_type) REFERENCES tenancy_types (tenancy_type),
	FOREIGN KEY (deposit_id) REFERENCES deposit (deposit_id)
)
	ENGINE MyISAM;

CREATE TABLE tenant_tenancy_mapping (
	tenancy_id INT NOT NULL,
	person_id  INT NOT NULL,
	FOREIGN KEY (tenancy_id) REFERENCES tenancy (tenancy_id),
	FOREIGN KEY (person_id) REFERENCES person (person_id)
)
	ENGINE MyISAM;

COMMIT;