/*
- Create 'propman' database
- Create version table

NB Run on root
*/

CREATE DATABASE propman;

USE propman;

CREATE TABLE version (
  version_number VARCHAR(32) NOT NULL UNIQUE,
  description VARCHAR(200),
  PRIMARY KEY(version_number)
) ENGINE MyISAM;

COMMIT;