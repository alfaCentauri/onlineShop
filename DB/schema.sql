/* 
 * License GNU.
 */
/**
 * Author:  Ricardo Presilla.
 * Created: 03/06/2019
 */
create database shop;
/**For online shop*/
grant all privileges on shop.* to 'phptest'@'localhost' identified by 'userShop.19' with grant option;

use shop;

drop table users;
CREATE TABLE users (
  id int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key ',
  firstName varchar(50) COLLATE utf8_bin DEFAULT NULL,
  lastName varchar(50) COLLATE utf8_bin DEFAULT NULL,
  email varchar(255) COLLATE utf8_bin NOT NULL,
  login varchar(100) COLLATE utf8_bin NOT NULL,
  password varchar(20) COLLATE utf8_bin NOT NULL,
  active tinyint(1) NOT NULL,
  creationDate date NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

drop table products;
CREATE TABLE products (
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary key ' , 
	name VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Product name' , 
	price FLOAT NOT NULL COMMENT 'Price without product tax' ,
	image VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Name of the product image' ,
	stock INT(10) NOT NULL , 
	creationDate DATE NOT NULL ,
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

drop table qualification;
CREATE TABLE qualification (
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary key ' ,
	idUser int(11) NOT NULL,
	idProduct INT(10) UNSIGNED NOT NULL,
	points INT DEFAULT 0,
	creationDate DATE NOT NULL ,
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

drop table carts;
CREATE TABLE carts(
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary key ' , 
    idUser int(11) NOT NULL, 
    totalPrice FLOAT NOT NULL DEFAULT 0,
    direction VARCHAR (100),
    paidOut BOOLEAN DEFAULT FALSE,
    creationDate DATE NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

drop table itemsCart;
CREATE TABLE IF NOT EXISTS itemsCart (
  id INT NOT NULL AUTO_INCREMENT,
  idCart INT(10) UNSIGNED NOT NULL,
  idProduct INT(10) UNSIGNED NOT NULL,
  quantity INT(10) UNSIGNED NOT NULL DEFAULT 0,
  totalPrice FLOAT NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  INDEX carts (idCart ASC),
  INDEX products (idProduct ASC)
  ) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COLLATE = utf8_bin COMMENT = 'Items por carrito.';

/**Data of test*/
INSERT INTO products (id, name, price, image, stock, creationDate) VALUES
(1, 'Apple red', 0.3, '4208manzana.jpg', 499, '2019-06-05'),
(2, 'Water bottle 5 liters', 1, '4305agua-mineral-minalba-5-lts.jpg', 599, '2019-06-05'),
(3, 'Beer', 2, '4356Smirnoff-Ice-Manzana-Verde-_355ml_-Front.jpg', 994, '2019-06-05'),
(4, 'Cheese', 3.74, '4542portada-wp-quesos-600x363.jpg', 199, '2019-06-05'),
(5, 'Melon', 0.5, '1929melon.jpg', 700, '2019-06-05');

INSERT INTO users (id, firstName, lastName, email, login, password, active, creationDate) VALUES
(1, 'Pedro', 'Perez', 'pepe@dominio.com', 'pepe', '123456', 1, '2019-06-06');

