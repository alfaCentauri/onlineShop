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
    /**
     * It contains the index
     * @var int
     */
    private $id;
    /**
     * It contains the index of the user.
     * @var int
     */
    private $idUser;
    /**
     * It contains the index of the product.
     * @var int
     */
    private $idProduct;
    /**
     * It contains the points del product.
     * @var int
     */
    private $points;
    /**
     * Contains creation date 
     * @var mixed
     */
    private $creationDate;
    /**
     * Conetion to DB.
     */
    private $conn;
    /**
     * Qualification constructor.
     */
    function __construct()
    {
        $this->conn = new Conection();
        $this->id = 0;
        $this->idUser = 0;
        $this->idProduct = 0;
        $this->points = 0;
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
    public function getPoints(): int
    {
        return $this->points;
    }

    /**
     * @param int $points
     */
    public function setPoints(int $points): void
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
        $sql = "INSERT INTO qualification(id, idUser, idProduct, points, creationDate) 
          VALUES(NULL, '{$this->idUser}', '{$this->idProduct}', '{$this->points}', NOW());";
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
     * View a register.
     * @return bool|\mysqli_result Return an arrangement with the record.
     */
    public function view()
    {
        $sql = "SELECT Q.*, P.name as name_product, P.image as image_product 
          FROM qualification Q 
          INNER JOIN products P 
          on Q.idProduct=P.id and Q.id='{$this->id}';";
        $data = $this->conn->ReturnQuery($sql);
        return $data;
    }
    /**
     * Find a register by the user current.
     * @return bool|\mysqli_result
     */
    public function findByUser()
    {
        $sql = "SELECT Q.*, P.name as name_product, P.image as image_product 
          FROM qualification Q 
          INNER JOIN users U on Q.idUser='{$this->idUser}' and Q.idUser=U.id  
          INNER JOIN products P 
          on Q.idProduct=P.id;";
        $data = $this->conn->ReturnQuery($sql);
        return $data;
    }
    /**
     * List all the average.
     * @return bool|\mysqli_result
     */
    public function listAverage()
    {
        $sql = "SELECT Q.idProduct, AVG(Q.points) as average, P.name as name_product, P.image as image_product 
          FROM qualification Q 
          INNER JOIN products P 
          on Q.idProduct=P.id;";
        $data = $this->conn->ReturnQuery($sql);
        return $data;
    }
}
