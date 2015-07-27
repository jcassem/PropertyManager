/*
Update person table to add optional address id
*/

INSERT INTO version (version_number, description)
VALUES ('update_5', 'Update person table to add optional address id');

ALTER TABLE person ADD address_id INT;

ALTER TABLE person ADD FOREIGN KEY (address_id) REFERENCES address (address_id);

COMMIT;