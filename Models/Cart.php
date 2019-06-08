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
class Cart implements Crud
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
     * Constains the total price.
     * @var float
     */
    private $totalPrice;
    /**
     * Contains the direction of shipping.
     * @var String
     */
    private $direction;
    /**
     * @var Boolean
     */
    private $paidOut;
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
        $this->direction ="";
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
     * @return String
     */
    public function getDirection(): String
    {
        return $this->direction;
    }

    /**
     * @param String $direction
     */
    public function setDirection(String $direction): void
    {
        $this->direction = $direction;
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

    /**
     * Get a list of all the records.
     */
    public function toList()
    {
        $sql = "SELECT * FROM carts;";
        $data = $this->conn->ReturnQuery($sql);
        return $data;
    }
    /**
     * Get a list of all records with the image and the name of the associated
     * product.
     */
    public function toList2()
    {
        $sql = "SELECT T1.*, T2.name as name_product, T2.image as image_product FROM shop.carts T1 INNER JOIN shop.products T2 on T1.idProduct=T2.id ;";
        $data = $this->conn->ReturnQuery($sql);
        return $data;
    }
    /**
     * Get a list of all the records for a user.
     * @return bool|\mysqli_result Return a list of all the records for a user.
     */
    public function toListUser()
    {
        $sql = "SELECT C.*, I.quantity ,I.totalPrice, P.name as name_product, P.image as image_product 
          FROM shop.carts C 
          INNER JOIN shop.itemscart I 
          on C.id=I.idCart and C.id='{$this->id}' and C.idUser='{$this->idUser}' 
          INNER JOIN shop.products P on P.id=I.idProduct ";
        $data = $this->conn->ReturnQuery($sql);
        return $data;
    }

    /**
     * Generates a list to show all the items in a cart for a specific user.
     * @return bool|\mysqli_result
     */
    public function toListItemsCart()
    {
        $sql = "SELECT C.*, I.quantity ,I.totalPrice, P.name as name_product, P.image as image_product 
	      FROM shop.carts C 
	      INNER JOIN shop.itemscart I 
	      on C.id=I.idCart and C.id='{$this->id}' and C.idUser='{$this->idUser}' 
	      INNER JOIN shop.products P 
	      on P.id=I.idProduct ";
        $data = $this->conn->ReturnQuery($sql);
        return $data;
    }
    /**
     * Add register
     */
    public function add()
    {
        $sql = "INSERT INTO carts(id, idUser, totalPrice, direction, paidOut, creationDate) 
                VALUES(NULL, '{$this->idUser}', '{$this->totalPrice}', '{$this->direction}', 
                '{$this->paidOut}', NOW());";
        $this->conn->SimpleQuery($sql);
    }
    /**
     * View register.
     * @return array|null Return an arrangement with the record. 
     */
    public function view()
    {
        $sql = "SELECT T1.*, T2.name as name_product, T2.image as image_product FROM shop.carts T1 INNER JOIN shop.products T2 on T1.idProduct=T2.id and T1.id='{$this->id}';";
        $data = $this->conn->ReturnQuery($sql);
        $row = mysqli_fetch_assoc($data);
        return $row;
    }
    /**
     * View register with stock.
     * @return array|null Return an arrangement with the record.
     */
    public function view_Stock()
    {
        $sql = "SELECT T1.*, T2.name as name_product, T2.image as image_product, T2.stock as stock FROM shop.carts T1 INNER JOIN shop.products T2 on T1.idProduct=T2.id and T1.id='{$this->id}';";
        $data = $this->conn->ReturnQuery($sql);
        $row = mysqli_fetch_assoc($data);
        return $row;
    }
    /**
     * Edit record indicated by the current id.
     */
    public function edit(){
        $sql = "update carts set totalPrice='{$this->totalPrice}', direction='{$this->direction}', paidOut='{$this->paidOut}' where id='{$this->id}';";
        $this->conn->SimpleQuery($sql);
    }
    /**
     * Delete record indicated by the current id.
     */
    public function delete(){
        $sql = "delete from carts where id='{$this->id}';";
        $this->conn->SimpleQuery($sql);
    }
}
