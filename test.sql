CREATE TABLE MpesaTransactions (
    id int  AUTO_INCREMENT,
    TransID varchar(255),
    TransTime varchar(255),
    TransAmount varchar(255),
    MSISDN varchar(255),
    FirstName varchar(255),
    MiddleName varchar(255),
    LastName varchar(255),
    ResultDesc varchar(255),
    Code varchar(255),
    BillRefNumber varchar(255),
    date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id)
);