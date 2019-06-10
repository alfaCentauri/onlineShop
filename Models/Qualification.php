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
 * This is the qualification of the product.
 *
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 1.0.
 */
class Qualification implements Crud
{
    /**It contains the index*/
    private $id;
    private $idUser;
    private $idProduct;
    private $points;
    private $creationDate;
    /**Conetion to DB.*/
    private $conn;
    /***/
    function __construct()
    {
        $this->conn = new Conection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser): void
    {
        $this->idUser = $idUser;
    }

    /**
     * @return mixed
     */
    public function getIdProduct()
    {
        return $this->idProduct;
    }

    /**
     * @param mixed $idProduct
     */
    public function setIdProduct($idProduct): void
    {
        $this->idProduct = $idProduct;
    }

    /**
     * @return mixed
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param mixed $points
     */
    public function setPoints($points): void
    {
        $this->points = $points;
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
     * @return mixed
     */
    public function getConn()
    {
        return $this->conn;
    }

    /**
     * @param mixed $conn
     */
    public function setConn($conn): void
    {
        $this->conn = $conn;
    }
    /**
     * Add register
     */
    public function add()
    {
        $sql = "INSERT INTO qualification(id, idUser, idProduct, points, creationDate) VALUES(NULL, '{$this->idUser}', '{$this->idProduct}', '{$this->points}', NOW());";
        $this->conn->SimpleQuery($sql);
    }
    /**
     * Delete record indicated by the current id.
     */
    public function delete()
    {
        $sql = "delete from qualification where id='{$this->id}';";
        $this->conn->SimpleQuery($sql);
    }
    /**
     * Edit record indicated by the current id.
     */
    public function edit()
    {
        $sql = "update qualification set ponits='{$this->points}' where id='{$this->id}';";
        $this->conn->SimpleQuery($sql);
    }
    /**
     * Get a list of all the records.
     */
    public function toList()
    {
        $sql = "SELECT * FROM qualification;";
        $data = $this->conn->ReturnQuery($sql);
        return $data;
    }

    /**
     * View register.
     * @return bool|\mysqli_result Return an arrangement with the record.
     */
    public function view()
    {
        $sql = "SELECT T1.*, T2.name as name_product, T2.image as image_product FROM qualification T1 INNER JOIN products T2 on T1.idProduct=T2.id and T1.id=id='{$this->id}';";
        $data = $this->conn->ReturnQuery($sql);
        return $data;
    }

}
