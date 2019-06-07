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
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;*/

drop table shop.products;
CREATE TABLE shop.products (
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary key ' , 
	name VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Product name' , 
	price FLOAT NOT NULL COMMENT 'Price without product tax' ,
	image VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Name of the product image' ,
	stock INT(10) NOT NULL , 
	creationDate DATE NOT NULL ,
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

drop table shop.qualification;
CREATE TABLE shop.qualification (
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary key ' ,
	idUser int(11) NOT NULL,
	idProduct INT(10) UNSIGNED NOT NULL,
	points INT DEFAULT 0,
	creationDate DATE NOT NULL ,
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

drop table shop.carts;
CREATE TABLE shop.carts(
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary key ' , 
    idUser int(11) NOT NULL,    
    creationDate DATE NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

drop table shop.itemsCart;
CREATE TABLE IF NOT EXISTS shop.itemsCart (
  id INT NOT NULL AUTO_INCREMENT,
  idProduct INT(10) UNSIGNED NOT NULL,
  quantity INT(10) UNSIGNED NOT NULL DEFAULT 0,
  totalPrice FLOAT NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  INDEX Carrito (idProduct ASC),
  CONSTRAINT fk_itemsCart_1
    FOREIGN KEY (id)
    REFERENCES shop.carts (idUser)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_itemsCart_2
    FOREIGN KEY (idProduct)
    REFERENCES shop.products (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin
COMMENT = 'Items por carrito.';

/**Data de pruebas*/
INSERT INTO shop.products (id, name, price, image, stock, creationDate) VALUES
(1, 'Apple red', 0.3, '4208manzana.jpg', 499, '2019-06-05'),
(2, 'Water bottle 5 liters', 1, '4305agua-mineral-minalba-5-lts.jpg', 599, '2019-06-05'),
(3, 'Beer', 2, '4356Smirnoff-Ice-Manzana-Verde-_355ml_-Front.jpg', 994, '2019-06-05'),
(4, 'Cheese', 3.74, '4542portada-wp-quesos-600x363.jpg', 199, '2019-06-05'),
(5, 'Melon', 0.5, '1929melon.jpg', 700, '2019-06-05');
SELECT * FROM shop.products LIMIT 100;

INSERT INTO shop.users (id, firstName, lastName, email, login, password, active, creationDate) VALUES
(1, 'Pedro', 'Perez', 'pepe@dominio.com', 'pepe', '123456', 1, '2019-06-06');

INSERT INTO shop.carts (id, idUser, idProduct, quantity, totalPrice, creationDate) VALUES
(13, 1, 1, 1, 0.3, '2019-06-07'),
(14, 1, 2, 1, 1, '2019-06-07'),
(15, 1, 3, 6, 12, '2019-06-07'),
(16, 1, 4, 1, 3.74, '2019-06-07');
SELECT * FROM shop.carts LIMIT 100;