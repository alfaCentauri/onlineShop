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
    /**
     * @var Conection
     */
    private $conn;
    /**
     * It contains the index
     * @var integer
     */
    private $id;
    /**
     * @var integer
     */
    private $idUser;
    /**
     * @var integer
     */
    private $idProduct;
    /**
     * Constains the quantity.
     * @var integer
     */
    private $quantity;
    /**
     * Constains the total price.
     * @var float
     */
    private $totalPrice;
    /**
     * Contains creation date.
     */
    private $creationDate;
    /**
     * Cart constructor.
     */
    function __construct()
    {
        $this->conn = new Conection();
        $this->id = 0;
        $this->idUser = 0;
        $this->idProduct = 0;
        $this->quantity = 0;
    }

    /**
     * @return Conection
     */
    public function getConn(): Conection
    {
        return $this->conn;
    }

    /**
     * @param Conection $conn
     */
    public function setConn(Conection $conn): void
    {
        $this->conn = $conn;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->idUser;
    }

    /**
     * @param int $idUser
     */
    public function setIdUser(int $idUser): void
    {
        $this->idUser = $idUser;
    }

    /**
     * @return int
     */
    public function getIdProduct(): int
    {
        return $this->idProduct;
    }

    /**
     * @param int $idProduct
     */
    public function setIdProduct(int $idProduct): void
    {
        $this->idProduct = $idProduct;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    /**
     * @param float $totalPrice
     */
    public function setTotalPrice(float $totalPrice): void
    {
        $this->totalPrice = $totalPrice;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param mixed $creationDate
     */
    public function setCreationDate($creationDate): void
    {
        $this->creationDate = $creationDate;
    }

    /***/
    public function toList()
    {
        $sql = "SELECT * FROM carts;";
        $data = $this->conn->ReturnQuery($sql);
        return $data;
    }
    /***/
    public function toList2()
    {
        $sql = "SELECT T1.*, T2.name as name_product, T2.image as image_product FROM shop.carts T1 INNER JOIN shop.products T2 on T1.idProduct=T2.id ;";
        $data = $this->conn->ReturnQuery($sql);
        return $data;
    }
    /**Add register*/
    public function add(){
        $sql = "INSERT INTO carts(id, idUser, idProduct, quantity, totalPrice, creationDate) VALUES(NULL, '{$this->idUser}', '{$this->idProduct}', '{$this->quantity}', '{$this->totalPrice}', NOW());";
        print $sql;
        $this->conn->SimpleQuery($sql);
    }

}
