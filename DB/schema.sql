/* 
 * License GNU.
 */
/**
 * Author:  Ricardo Presilla.
 * Created: 03/06/2019
 */
create database shop;
/**For online shop*/
grant all privileges on shop.* to 'userShop'@'localhost' identified by 'userShop.19' with grant option;
use shop;

drop table shop.users;
CREATE TABLE shop.users (
  id int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key ',
  firstName varchar(50) COLLATE utf8_bin DEFAULT NULL,
  lastName varchar(50) COLLATE utf8_bin DEFAULT NULL,
  email varchar(255) COLLATE utf8_bin NOT NULL,
  login varchar(100) COLLATE utf8_bin NOT NULL,
  password varchar(20) COLLATE utf8_bin NOT NULL,
  active tinyint(1) NOT NULL,
  creationDate date NOT NULL,
  PRIMARY KEY (id),
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

drop table shop.products;
CREATE TABLE shop.products (
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary key ' , 
	name VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Product name' , 
	cost FLOAT NOT NULL COMMENT 'Product cost' ,
	taxPercentage FLOAT NOT NULL COMMENT 'percentage of tax on the price of the product' , 
	price FLOAT NOT NULL COMMENT 'Price without product tax' , 
	active BOOLEAN NOT NULL , 
	creationDate DATE NOT NULL ,
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE shop.products (
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary key ' , 
	name VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Product name' , 
	price FLOAT NOT NULL COMMENT 'Price without product tax' , 
	stock INT(10) NOT NULL , 
	creationDate DATE NOT NULL ,
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
