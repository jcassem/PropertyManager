/*
- Create deposit protection scheme
- Create tenancy types
- Create account types
*/

INSERT INTO version (version_number, description) VALUES ('update_4', 'Add deposit and tenancy types');

# DEPOSIT PROTECTION SCHEME
INSERT INTO deposit_protection_schemes (deposit_type, description)
VALUES ('TDS', 'Tenancy Deposit Scheme');
INSERT INTO deposit_protection_schemes (deposit_type, description)
VALUES ('MyDeposits', 'MyDeposits.com');
INSERT INTO deposit_protection_schemes (deposit_type, description)
VALUES ('N/A', 'No protection needed');
INSERT INTO deposit_protection_schemes (deposit_type, description)
VALUES ('Other', 'Other protection scheme used');

# TENANT TYPES
INSERT INTO tenancy_types (tenancy_type, description)
VALUES ('AST', 'Assured Short-hold Tenancy');
INSERT INTO tenancy_types (tenancy_type, description)
VALUES ('Lodger', 'Lodgers Agreement - Excluded Tenancy Agreement');
INSERT INTO tenancy_types (tenancy_type, description)
VALUES ('Company Let', 'Company Let Agreement');
INSERT INTO tenancy_types (tenancy_type, description)
VALUES ('Owner Occupier Tenancy', 'Owner Occupier Tenancy Agreement');
INSERT INTO tenancy_types (tenancy_type, description)
VALUES ('Non AST', 'Non Assured Tenancy Agreement');
INSERT INTO tenancy_types (tenancy_type, description)
VALUES ('Other', 'Other tenancy type not listed');

# ACCOUNT TYPES
INSERT INTO account_types (account_type, property_limit, description)
VALUES ('FREE', 5, 'Free account');
INSERT INTO account_types (account_type, property_limit, description)
VALUES ('BRONZE', 15, 'Bronze account');
INSERT INTO account_types (account_type, property_limit, description)
VALUES ('SILVER', 25, 'Silver account');
INSERT INTO account_types (account_type, property_limit, description)
VALUES ('GOLD', 100, 'Gold account');
INSERT INTO account_types (account_type, property_limit, description)
VALUES ('PLATINUM', 1000, 'Platinum/Unlimited account');

COMMIT;