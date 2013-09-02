CREATE TABLE causes_influences (
  cause     int(11) NOT NULL, 
  influence int(10) NOT NULL, 
  PRIMARY KEY (cause, 
  influence)) ENGINE=InnoDB;
CREATE TABLE influences (
  id          int(10) NOT NULL AUTO_INCREMENT, 
  achievement int(10) NOT NULL, 
  impact      int(10) NOT NULL, 
  quantity    int(10) NOT NULL, 
  minCost     float, 
  maxCost     float, 
  PRIMARY KEY (id)) ENGINE=InnoDB;
CREATE TABLE impacts (
  id   int(10) NOT NULL AUTO_INCREMENT, 
  name varchar(255), 
  PRIMARY KEY (id)) ENGINE=InnoDB;
CREATE TABLE quantities (
  id   int(10) NOT NULL AUTO_INCREMENT, 
  name varchar(255), 
  PRIMARY KEY (id)) ENGINE=InnoDB;
CREATE TABLE achievements (
  id   int(10) NOT NULL AUTO_INCREMENT, 
  name varchar(255), 
  PRIMARY KEY (id)) ENGINE=InnoDB;
CREATE TABLE wheres (
  id      int(10) NOT NULL AUTO_INCREMENT, 
  country varchar(3) NOT NULL, 
  PRIMARY KEY (id)) ENGINE=InnoDB;
CREATE TABLE whats (
  id  int(10) NOT NULL AUTO_INCREMENT, 
  tag int(10) NOT NULL, 
  PRIMARY KEY (id)) ENGINE=InnoDB;
CREATE TABLE whos (
  id   int(10) NOT NULL AUTO_INCREMENT, 
  name varchar(255), 
  PRIMARY KEY (id)) ENGINE=InnoDB;
CREATE TABLE causes (
  id      int(11) NOT NULL AUTO_INCREMENT, 
  what    int(10) NOT NULL, 
  `where` int(10) NOT NULL, 
  who     int(10) NOT NULL, 
  PRIMARY KEY (id)) ENGINE=InnoDB;
ALTER TABLE causes_influences ADD INDEX FKcauses_inf52218 (influence), ADD CONSTRAINT FKcauses_inf52218 FOREIGN KEY (influence) REFERENCES influences (id);
ALTER TABLE causes_influences ADD INDEX FKcauses_inf492683 (cause), ADD CONSTRAINT FKcauses_inf492683 FOREIGN KEY (cause) REFERENCES causes (id);
ALTER TABLE influences ADD INDEX FKinfluences339399 (impact), ADD CONSTRAINT FKinfluences339399 FOREIGN KEY (impact) REFERENCES impacts (id);
ALTER TABLE influences ADD INDEX FKinfluences558306 (quantity), ADD CONSTRAINT FKinfluences558306 FOREIGN KEY (quantity) REFERENCES quantities (id);
ALTER TABLE influences ADD INDEX FKinfluences88276 (achievement), ADD CONSTRAINT FKinfluences88276 FOREIGN KEY (achievement) REFERENCES achievements (id);
ALTER TABLE causes ADD INDEX FKcauses732187 (who), ADD CONSTRAINT FKcauses732187 FOREIGN KEY (who) REFERENCES whos (id);
ALTER TABLE causes ADD INDEX FKcauses331683 (`where`), ADD CONSTRAINT FKcauses331683 FOREIGN KEY (`where`) REFERENCES wheres (id);
ALTER TABLE causes ADD INDEX FKcauses756010 (what), ADD CONSTRAINT FKcauses756010 FOREIGN KEY (what) REFERENCES whats (id);

