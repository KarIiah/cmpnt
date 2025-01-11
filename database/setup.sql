CREATE DATABASE CMPNT_TELEPHONE;

USE CMPNT_TELEPHONE;

CREATE TABLE Entry
(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(50),
    lastName  VARCHAR(50),
    firstNameT9 VARCHAR(50),
    lastNameT9  VARCHAR(50),
    telephoneNr VARCHAR(20),
    createdAt timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    updatedAt timestamp NULL ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO Entry (firstName, lastName, firstNameT9, lastNameT9, telephoneNr)
VALUES ("Max", "Muster", "518", "576726", "+49 1747567482");


INSERT INTO Entry (firstName, lastName, firstNameT9, lastNameT9, telephoneNr)
VALUES ("John", "Doe", "4535", "252", "+1 5551234567");