/*
- Create test user/landlord
- Create tenant
- Create property (& address)
- Create tenancy (& deposit)

NB Made for update_4
*/

# Create test uesr / landlord
INSERT INTO person (type, first_name, second_name, company_name, email_address, mobile_number, notes)
VALUES ('LANDLORD', 'Joe', 'Lordland', 'Prop Co.', 'joe@prop.co', '07778889990', 'Test user & landlord');

INSERT INTO user (username, password, person_id, account_type)
	SELECT
		'propco',
		'920688bd88d6a1ba0e177f17bdf6dddd',
		person_id,
		'FREE'
	FROM person
	WHERE first_name = 'Joe' AND second_name = 'Lordland';

# CREATE TEST TENANT
INSERT INTO person (salutation, type, first_name, second_name, email_address, mobile_number, notes)
VALUES ('Ms', 'TENANT', 'Jane', 'Tenot', 'jane.tenot@email.com', '07123456789', 'Test tenant');

# CREATE TEST PROPERTY
INSERT INTO address (house_number, street_name, second_line, city, county, postcode)
VALUES ('123', 'fake street', 'town place', 'city something', 'le county', 'postcode');

INSERT INTO property (address_id, landlord_id, notes)
	SELECT
		ad.address_id,
		per.person_id,
		'Test property'
	FROM address ad, person per
	WHERE ad.house_number = '123' AND ad.postcode = 'postcode'
				AND per.first_name = 'Joe' AND per.second_name = 'Lordland';

# CREATE TEST TENANCY
INSERT INTO deposit (amount, date_received, protection_scheme)
VALUES (1500, '2015-07-01', 'MyDeposits');

INSERT INTO tenancy (property_id, start_date, expiry_date, monthly_rent, tenancy_type, deposit_id, notes)
	SELECT
		prop.property_id,
		'2015-07-01',
		'2016-06-30',
		1500,
		'AST',
		dep.deposit_id,
		'Test tenancy'
	FROM property prop, deposit dep
	WHERE prop.notes = 'Test property'
				AND dep.amount = 1500 AND date_received = '2015-07-01';

INSERT INTO tenant_tenancy_mapping (tenancy_id, person_id)
	SELECT
		ten.tenancy_id,
		per.person_id
	FROM tenancy ten, person per
	WHERE ten.notes = 'Test tenancy'
				AND per.first_name = 'Jane' AND per.second_name = 'Tenot';

COMMIT;