CREATE TABLE Role_User (Roleid int(10) NOT NULL, Userid int(10) NOT NULL, PRIMARY KEY (Roleid, Userid));
CREATE TABLE Role (id int(10) NOT NULL AUTO_INCREMENT, name varchar(255), PRIMARY KEY (id));
CREATE TABLE `Session` (id int(10) NOT NULL AUTO_INCREMENT comment 'Identificador de la sesión', ini datetime NULL, end datetime NULL, state tinyint, ipIni varchar(18), ipEnd varchar(18), phpSession varchar(255), `user` int(10) NOT NULL, PRIMARY KEY (id));
CREATE TABLE `User` (id int(10) NOT NULL, email varchar(255), password varchar(255), salt varchar(255), PRIMARY KEY (id));
CREATE TABLE Person (id int(10) NOT NULL AUTO_INCREMENT, name varchar(100), lastname varchar(100), PRIMARY KEY (id));
ALTER TABLE `User` ADD INDEX FKUser198555 (id), ADD CONSTRAINT FKUser198555 FOREIGN KEY (id) REFERENCES Person (id);
ALTER TABLE `Session` ADD INDEX FKSession78200 (`user`), ADD CONSTRAINT FKSession78200 FOREIGN KEY (`user`) REFERENCES `User` (id);
ALTER TABLE Role_User ADD INDEX FKRole_User91338 (Roleid), ADD CONSTRAINT FKRole_User91338 FOREIGN KEY (Roleid) REFERENCES Role (id);
ALTER TABLE Role_User ADD INDEX FKRole_User569933 (Userid), ADD CONSTRAINT FKRole_User569933 FOREIGN KEY (Userid) REFERENCES `User` (id);

