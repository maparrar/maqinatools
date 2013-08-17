<?php
    require_once 'core/Struct.php';
    require_once 'core/Generator.php';
    
    
    $sql='
        CREATE TABLE PayLoan (pay int(10) NOT NULL, loan int(10) NOT NULL, amount bigint(20), PRIMARY KEY (pay, loan));
CREATE TABLE Loan (id int(10) NOT NULL AUTO_INCREMENT, `date` datetime NULL, interest float, paid bigint(20), `from` int(10) NOT NULL, `to` int(10) NOT NULL, PRIMARY KEY (id));
CREATE TABLE PaySale (pay int(10) NOT NULL, sale int(10) NOT NULL, amount bigint(20), PRIMARY KEY (pay, sale));
CREATE TABLE SaleProduct (sale int(10) NOT NULL, product int(10) NOT NULL, units int(10), priceReal bigint(20), PRIMARY KEY (sale, product));
CREATE TABLE Sale (id int(10) NOT NULL AUTO_INCREMENT, `date` datetime NULL, totalReal bigint(20), paid bigint(20), client int(10) NOT NULL, PRIMARY KEY (id));
CREATE TABLE PayPurchase (pay int(10) NOT NULL, purchase int(10) NOT NULL, amount bigint(20), PRIMARY KEY (pay, purchase));
CREATE TABLE PurchaseProduct (purchase int(10) NOT NULL, product int(10) NOT NULL, units int(10), priceAprox bigint(20), priceReal bigint(20), PRIMARY KEY (purchase, product));
CREATE TABLE Purchase (id int(10) NOT NULL AUTO_INCREMENT, `date` datetime NULL, totalAprox bigint(20), totalReal bigint(20), paid bigint(20), provider int(10) NOT NULL, PRIMARY KEY (id));
CREATE TABLE ProductPrice (id int(10) NOT NULL AUTO_INCREMENT, product int(10) NOT NULL, `date` datetime NULL, pricePurchase int(10), priceSale int(10), PRIMARY KEY (id));
CREATE TABLE Product (id int(10) NOT NULL AUTO_INCREMENT, name varchar(255), PRIMARY KEY (id));
CREATE TABLE Pay (id int(10) NOT NULL AUTO_INCREMENT, `date` datetime NULL, amount int(10), `from` int(10) NOT NULL, `to` int(10) NOT NULL, PRIMARY KEY (id));
CREATE TABLE Client (id int(10) NOT NULL, PRIMARY KEY (id));
CREATE TABLE Provider (id int(10) NOT NULL, PRIMARY KEY (id));
CREATE TABLE `User` (id int(10) NOT NULL, password varchar(255), salt varchar(255), PRIMARY KEY (id));
CREATE TABLE Person (id int(10) NOT NULL AUTO_INCREMENT, name varchar(100), lastname varchar(100), phone varchar(100), PRIMARY KEY (id));
ALTER TABLE `User` ADD INDEX FKUser198555 (id), ADD CONSTRAINT FKUser198555 FOREIGN KEY (id) REFERENCES Person (id);
ALTER TABLE Provider ADD INDEX FKProvider275316 (id), ADD CONSTRAINT FKProvider275316 FOREIGN KEY (id) REFERENCES Person (id);
ALTER TABLE Client ADD INDEX FKClient279495 (id), ADD CONSTRAINT FKClient279495 FOREIGN KEY (id) REFERENCES Person (id);
ALTER TABLE Pay ADD INDEX FKPay616110 (`from`), ADD CONSTRAINT FKPay616110 FOREIGN KEY (`from`) REFERENCES Person (id);
ALTER TABLE Pay ADD INDEX FKPay764192 (`to`), ADD CONSTRAINT FKPay764192 FOREIGN KEY (`to`) REFERENCES Person (id);
ALTER TABLE ProductPrice ADD INDEX FKProductPri291473 (product), ADD CONSTRAINT FKProductPri291473 FOREIGN KEY (product) REFERENCES Product (id);
ALTER TABLE PurchaseProduct ADD INDEX FKPurchasePr866285 (purchase), ADD CONSTRAINT FKPurchasePr866285 FOREIGN KEY (purchase) REFERENCES Purchase (id);
ALTER TABLE PurchaseProduct ADD INDEX FKPurchasePr724031 (product), ADD CONSTRAINT FKPurchasePr724031 FOREIGN KEY (product) REFERENCES Product (id);
ALTER TABLE Purchase ADD INDEX FKPurchase373928 (provider), ADD CONSTRAINT FKPurchase373928 FOREIGN KEY (provider) REFERENCES Provider (id);
ALTER TABLE PayPurchase ADD INDEX FKPayPurchas625766 (pay), ADD CONSTRAINT FKPayPurchas625766 FOREIGN KEY (pay) REFERENCES Pay (id);
ALTER TABLE PayPurchase ADD INDEX FKPayPurchas479978 (purchase), ADD CONSTRAINT FKPayPurchas479978 FOREIGN KEY (purchase) REFERENCES Purchase (id);
ALTER TABLE SaleProduct ADD INDEX FKSaleProduc144048 (sale), ADD CONSTRAINT FKSaleProduc144048 FOREIGN KEY (sale) REFERENCES Sale (id);
ALTER TABLE SaleProduct ADD INDEX FKSaleProduc529808 (product), ADD CONSTRAINT FKSaleProduc529808 FOREIGN KEY (product) REFERENCES Product (id);
ALTER TABLE Sale ADD INDEX FKSale982929 (client), ADD CONSTRAINT FKSale982929 FOREIGN KEY (client) REFERENCES Client (id);
ALTER TABLE PaySale ADD INDEX FKPaySale388455 (pay), ADD CONSTRAINT FKPaySale388455 FOREIGN KEY (pay) REFERENCES Pay (id);
ALTER TABLE PaySale ADD INDEX FKPaySale289643 (sale), ADD CONSTRAINT FKPaySale289643 FOREIGN KEY (sale) REFERENCES Sale (id);
ALTER TABLE Loan ADD INDEX FKLoan322212 (`from`), ADD CONSTRAINT FKLoan322212 FOREIGN KEY (`from`) REFERENCES Person (id);
ALTER TABLE Loan ADD INDEX FKLoan470294 (`to`), ADD CONSTRAINT FKLoan470294 FOREIGN KEY (`to`) REFERENCES Person (id);
ALTER TABLE PayLoan ADD INDEX FKPayLoan193040 (pay), ADD CONSTRAINT FKPayLoan193040 FOREIGN KEY (pay) REFERENCES Pay (id);
ALTER TABLE PayLoan ADD INDEX FKPayLoan703397 (loan), ADD CONSTRAINT FKPayLoan703397 FOREIGN KEY (loan) REFERENCES Loan (id);

';
    
        
    $generator=new Generator("maqinato","maparrar <maparrar@gmail.com>","https://github.com/maparrar/maqinato");
    $generator->readFromSQL($sql);
//    $generator->createFiles();