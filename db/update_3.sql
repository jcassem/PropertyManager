/*
- Create account type table
- Create user table
  - user/email and pass will be salted and hashed
(property limit = account_type.property_limit + user.bonus_properties)
*/

INSERT INTO version (version_number, description) VALUES ('update_3', 'Create account types and user tables');

CREATE TABLE account_types (
	account_type   VARCHAR(32) UNIQUE,
	property_limit INT,
	description    VARCHAR(200),
	PRIMARY KEY (account_type)
)
	ENGINE MyISAM;

CREATE TABLE user (
	user_id               INT         NOT NULL AUTO_INCREMENT,
	username         VARCHAR(32) NOT NULL UNIQUE,
	password         VARCHAR(32) NOT NULL,
	person_id        INT         NOT NULL,
	account_type     VARCHAR(32) NOT NULL,
	bonus_properties  int NOT NULL DEFAULT 0,
	PRIMARY KEY (user_id),
	FOREIGN KEY (person_id) REFERENCES person (person_id),
	FOREIGN KEY (account_type) REFERENCES account_types (account_type)
)
	ENGINE MyISAM;

COMMIT;