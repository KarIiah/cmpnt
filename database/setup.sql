CREATE DATABASE CMPNT_TELEPHONE;

USE CMPNT_TELEPHONE;

CREATE TABLE Entry
(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(50),
    lastName  VARCHAR(50),
    telephoneNr VARCHAR(20),
    createdAt timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    updatedAt timestamp NULL ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO Entry (firstName, lastName, telephoneNr)
VALUES ("Max", "Muster", "+49 1747567482");


INSERT INTO Entry (firstName, lastName, telephoneNr)
VALUES ("John", "Doe", "+1 5551234567");