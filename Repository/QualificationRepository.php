<?php

/**
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

namespace Repository;

use Models\Qualification;

/**
 * This is the qualification of the product.
 *
 * @package Models
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 1.1.
 */
class QualificationRepository extends Repository
{
    private Qualification $qualification;
    
    public function __construct(Qualification $qualification)
    {
        $this->qualification = $qualification;
    }
    
    /**
     * @inheritDoc
     */
    public function all()
    {
        $sql = "SELECT * FROM qualification;";
        $data = $this->conection->ReturnQuery($sql);
        return $data;
    }
    
    /**
     * @inheritDoc
     */
    public function find(int $id)
    {
        $sql = "SELECT * FROM qualification where id={$id}";
        $data = $this->conection->ReturnQuery($sql);
        $row = mysqli_fetch_assoc($data);
        return $row;
    }
    
    /**
     * @inheritDoc
     */
    public function findBy(String $param, String $value)
    {
        $sql = "SELECT * FROM qualification where {$param}='{$value}'";
        $data = $this->conection->ReturnQuery($sql);
        $row = mysqli_fetch_assoc($data);
        return $row;
    }
    
    /**
     * @inheritDoc
     */
    public function orderBy(string $param, string $order = 'ASC')
    {
        $sql = "SELECT * FROM qualification ORDER BY {$param} '{$order}'";
        $data = $this->conection->ReturnQuery($sql);
        return $data;
    }
    
    /**
     * @inheritDoc
     */
    public function add()
    {
        $sql = "INSERT INTO qualification(id, idUser, idProduct, points, creationDate) 
          VALUES(NULL, {$this->qualification->getIdUser()}, {$this->qualification->getIdProduct()}, 
            {$this->qualification->getPoints()}, NOW());";
        $data = $this->conection->InsertQuery($sql);
        return $data;
    }
    
    /**
     * @inheritDoc
     */
    public function edit()
    {
        $sql = "update qualification set points = {$this->qualification->getPoints()} where 
        id = {$this->qualification->getId()};";
        $this->conection->SimpleQuery($sql);
    }
    
    /**
     * @inheritDoc
     */
    public function view()
    {
        $sql = "SELECT Q.*, P.name as name_product, P.image as image_product 
          FROM qualification Q 
          INNER JOIN products P 
          on Q.idProduct=P.id and Q.id= {$this->qualification->getId()};";
        $data = $this->conection->ReturnQuery($sql);
        $row = mysqli_fetch_assoc($data);
        return $row;
    }
    
    /**
     * @inheritDoc
     */
    public function delete()
    {
        $sql = "delete from qualification where id = {$this->qualification->getId()};";
        $this->conection->SimpleQuery($sql);
    }
    
    /**
     * Find all registers by the current user.
     * @return array
     */
    public function findByUser()
    {
        $sql = "SELECT Q.*, P.name as name_product, P.image as image_product 
          FROM qualification Q 
          INNER JOIN users U on Q.idUser= {$this->qualification->getIdUser()} and Q.idUser=U.id  
          INNER JOIN products P 
          on Q.idProduct=P.id;";
        $data = $this->conection->ReturnQuery($sql);
        $row = mysqli_fetch_assoc($data);
        return $row;
    }
    
    /**
     * Find a record for the current user and the product indicate by their index.
     * @return array
     */
    public function findByUserProduct()
    {
        $sql = "SELECT Q.*, P.name as name_product, P.image as image_product 
          FROM qualification Q 
          INNER JOIN users U on Q.idUser= {$this->qualification->getIdUser()} and Q.idUser=U.id  
          INNER JOIN products P 
          on Q.idProduct=P.id and Q.idProduct = {$this->qualification->getIdProduct()};";
        $data = $this->conection->ReturnQuery($sql);
        $row = mysqli_fetch_assoc($data);
        return $row;
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
        $data = $this->conection->ReturnQuery($sql);
        return $data;
    }
    
    /**
     * Find a average for a product.
     * @return string[] Return a mysql result.
     */
    public function findAverage()
    {
        $sql = "SELECT Q.idProduct, AVG(Q.points) as average, P.name as name_product, P.image as image_product 
          FROM qualification Q 
          INNER JOIN products P 
          on Q.idProduct=P.id and Q.idProduct={$this->qualification->getIdProduct()};";
        $data = $this->conection->ReturnQuery($sql);
        $row = mysqli_fetch_assoc($data);
        return $row;
    }

    /**
     * @param array $dataQualification Array of data.
     */
    private function setQualification(array $dataQualification): void
    {
        $this->qualification->setId($dataQualification['id']);
    }
}
