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
class Cart {
    private $conn;
    /**It contains the index*/
    private $id;
    /**Constains the quantity*/
    private $quantity;
    /**Contains creation date */
    private $creationDate;
    function __construct() {
        $this->conn = new Conection();
    }
    /***/
    function getConn() {
        return $this->conn;
    }

    function getId() {
        return $this->id;
    }

    function getQuantity() {
        return $this->quantity;
    }

    function getCreationDate() {
        return $this->creationDate;
    }

    function setConn($conn) {
        $this->conn = $conn;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }


}
