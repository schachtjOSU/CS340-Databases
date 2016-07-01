-- beer table with the following properties:
-- BNum - an auto incrementing integer which is the primary key
-- BeerName - a varchar with a maximum length of 255 characters, cannot be null
-- Alc - a double 

DROP TABLE IF EXISTS `beer`;
CREATE TABLE `beer` (
  `BNum` int(11) NOT NULL AUTO_INCREMENT,
  `BeerName` varchar(255) NOT NULL,
  `Alc` double,
  PRIMARY KEY (`BNum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- hop table with the following properties:
-- HNum - an auto incrementing integer which is the primary key
-- BNum- an integer which is a foreign key reference to beer
-- HopName - a varchar with a maximum length of 255 characters, cannot be null
-- DatePick - a date type, cannot be null
-- DateExpired - a date type, cannot be null
-- WeightOz - a double 
-- NationGrown - a varchar with a maximum length of 25 characters
-- Form - a varchar with a maximum length of 25 characters

DROP TABLE IF EXISTS `hop`;
CREATE TABLE `hop` (
  `HNum` int(11) NOT NULL AUTO_INCREMENT,
  `BNum` int(11) NOT NULL,
  `HopName` varchar(255) NOT NULL,
  `DatePick` DATE NOT NULL,
  `DateExpired` DATE NOT NULL,
  `WeightOz` double,
  `NationGrown` varchar(25),
  `Form` varchar(25),
  PRIMARY KEY (`HNum`,`BNum`),
  KEY `idx_fk_BNum` (`BNum`),
  CONSTRAINT `fk_beer_hop` FOREIGN KEY (`BNum`) REFERENCES `beer` (`BNum`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- recipe table with the following properties:
-- RNum - an auto incrementing integer which is the primary key
-- BNum- an integer which is a foreign key reference to beer
-- name - a varchar with a maximum length of 255 characters, cannot be null

DROP TABLE IF EXISTS `recipe`;
CREATE TABLE `recipe` (
  `RNum` int(11) NOT NULL AUTO_INCREMENT,
  `BNum` int(11) NOT NULL,
  `RName` varchar(255) NOT NULL,
  PRIMARY KEY (`RNum`,`BNum`),
  KEY `idx_fk_bid` (`BNum`),
  CONSTRAINT `fk_beer_recipe` FOREIGN KEY (`BNum`) REFERENCES `beer` (`BNum`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ingredient table with the following properties:
-- INum - an auto incrementing integer which is the primary key
-- InName - a varchar with a maximum length of 255 characters, cannot be null

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE `ingredient` (
  `InNum` int(11) NOT NULL AUTO_INCREMENT,
  `InName` varchar(255) NOT NULL,
  PRIMARY KEY (`InNum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Recipe_ingredient table with the following properties, this is a table representing a many-to-many relationship
-- between recipe and ingredient:
-- RINum - an auto incrementing integer which is the primary key
-- RNum - an integer which is a foreign key reference to beer
-- InNum - an integer which is a foreign key reference to ingredient
-- Quantity - a TINYINT which shows the quantity of the ingredient 
-- The primary key is a combination of eid and pid

DROP TABLE IF EXISTS `recipe_ingredient`;
CREATE TABLE `recipe_ingredient` (
  `RINum` int(11) NOT NULL AUTO_INCREMENT,
  `RNum` INT(11) NOT NULL,
  `InNum` INT(11) NOT NULL,
  `Quantity` TINYINT NOT NULL,
  PRIMARY KEY (`RINum`),
  CONSTRAINT `fk_recipe_recipe_ingredient` FOREIGN KEY (`RNum`) REFERENCES `recipe` (`RNum`) ON UPDATE CASCADE,
  CONSTRAINT `fk_ingredient_recipe_ingredient`FOREIGN KEY (`InNum`) REFERENCES `ingredient` (`InNum`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;