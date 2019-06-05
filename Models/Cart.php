<?php

/*
 * Copyright (C) 2019 Ingeniero en Computación: Ricardo Presilla.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Models;

/**
 * Description of Cart
 *
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 1.0.
 */
class Cart
{
    private $conn;
    /**It contains the index*/
    private $id;
    /***/
    private $idUser;
    /***/
    private $idProduct;
    /**Constains the quantity*/
    private $quantity;
    /**Contains creation date */
    private $creationDate;
    /***/
    function __construct() 
    {
        $this->conn = new Conection();
    }
    /***/
    public function getConn() {
        return $this->conn;
    }

    public function getId() {
        return $this->id;
    }

    public function getIdUser() {
        return $this->idUser;
    }

    public function getIdProduct() {
        return $this->idProduct;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function setConn($conn) {
        $this->conn = $conn;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setIdUser($idUser) {
        $this->idUser = $idUser;
    }

    public function setIdProduct($idProduct) {
        $this->idProduct = $idProduct;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }
    /***/
    public function toList()
    {
        $sql = "SELECT * FROM carts;";
        $data = $this->con->ReturnQuery($sql);
        return $data;
    }
    /***/
    public function toList2()
    {
        $sql = "SELECT T1.*, T2.name as name_product, T2.image as image_product FROM shop.carts T1 INNER JOIN shop.products T2 on T1.idProduct=T2.id ;";
        $data = $this->con->ReturnQuery($sql);
        return $data;
    }
    /**Add register*/
    public function add(){
        $sql = "INSERT INTO carts(id, idUser, idProduct, quantity, creationDate) VALUES(NULL, '{$this->idUser}', '{$this->idProduct}', '{$this->quantity}', NOW());";
        $this->con->SimpleQuery($sql);
    }

}
