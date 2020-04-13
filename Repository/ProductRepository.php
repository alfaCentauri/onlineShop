<?php
/**
 * Copyright (C) 2020 Ingeniero en Computación: Ricardo Presilla.
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

use Models\Product;
use phpDocumentor\Reflection\Types\Integer;
/**
 * Repository of Class Products.
 *
 * @package Models
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 1.0.
 */
class ProductRepository extends Repository
{
    private Product $product;
    
    public __construct(Product $product)
    {
        $this->product = $product;
    }
    
    /**
     * @inheritDoc
     */
    public function all()
    {
        $sql = "SELECT * FROM products;";
        $data = $this->conection->ReturnQuery($sql);
        $rows = mysqli_fetch_assoc($data);
        return $rows;
    }
    
    /**
     * @inheritDoc
     */
    public function find(Integer $id)
    {
        $sql = "SELECT * FROM products where id='{$id}'";
        $data = $this->conection->ReturnQuery($sql);
        $row = mysqli_fetch_assoc($data);
        return $row;
    }
    
    /**
     * @inheritDoc
     */
    public function findBy(String $param, String $value)
    {
        $sql = "SELECT * FROM products where '{$param}'='{$value}';";
        $data = $this->conection->ReturnQuery($sql);
        $row = mysqli_fetch_assoc($data);
        return $row;
    }
    
    /**
     * @inheritDoc
     */
    public function orderBy(String $param, String $order = 'ASC')
    {
        $sql = "SELECT * FROM products ORDER BY {$param} '{$order}';";
        $data = $this->conection->ReturnQuery($sql);
        $rows = mysqli_fetch_assoc($data);
        return $rows;
    }
    
    /**
     * @inheritDoc
     */
    public function add()
    {
        $sql = "INSERT INTO products(name, price, image, stock, creationDate) VALUES('{$this->getName()}', '{$this->getPrice()}', '{$this->getImage()}', '{$this->getStock()}',NOW());";
        $this->conection->SimpleQuery($sql);
    }
    
    /**
     * @inheritDoc
     */
    public function delete()
    {
        $sql = "delete from products where id='{$this->getId()}';";
        $this->conection->SimpleQuery($sql);
    }
    
    /**
     * @inheritDoc
     */
    public function edit()
    {
        $sql = "update products set name='{$this->getName()}', price="
        . "'{$this->getPrice()}', stock='{$this->getStock()}' where id='{$this->getId()}';";
        $this->conection->SimpleQuery($sql);
    }
    
    /**
     * @inheritDoc
     */
    public function view()
    {
        $sql = "SELECT * FROM products where id='{$this->getId()}'";
        $data = $this->conection->ReturnQuery($sql);
        $row = mysqli_fetch_assoc($data);
        return $row;
    }
    
    /**
     * List witch average.     
     * 
     * @return null|array Result of the query.
     */
    public function toListAverage()
    {
        $sql = "SELECT P.* FROM products P INNER JOIN qualification Q
              ON Q.idProduct=P.id;";
        $data = $this->conection->ReturnQuery($sql);
        $rows = mysqli_fetch_assoc($data);
        return $rows;
    }
}