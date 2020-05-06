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

namespace Repository;

use Models\Cart;
use phpDocumentor\Reflection\Types\Integer;
/**
 * Repository for Class Cart.
 *
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 2.0.
 */
class CartRepository extends Repository
{
    private Cart $cart;
    
    /**
     * Constructor.
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
        //super("carts"); //Table: carts
    }

    /**
     * @inheritDoc
     */
    public function all()
    {
        $sql = "SELECT * FROM carts;";
        $data = $this->conection->ReturnQuery($sql);
        $rows = mysqli_fetch_assoc($data);
        return $rows;
    }
    
    /**
     * @inheritDoc
     */
    public function find(Integer $id)
    {
        $sql = "SELECT * FROM carts where id='{$id}'";
        $data = $this->conection->ReturnQuery($sql);
        setCart(mysqli_fetch_assoc($data));
        return $this->cart;
    }
    
    /**
     * @inheritDoc
     */
    public function findBy(String $param, String $value)
    {
        $sql = "SELECT * FROM carts where {$param}='{$value}'";
        $data = $this->conection->ReturnQuery($sql);
        $rows = mysqli_fetch_assoc($data);
        return $rows;
    }
    
    /**
     * @inheritDoc
     */
    public function orderBy(String $param, String $order = 'ASC')
    {
        $sql = "SELECT * FROM carts ORDER BY {$param} '{$order}'";
        $data = $this->conection->ReturnQuery($sql);
        $rows = mysqli_fetch_assoc($data);
        return $rows;
    }
    
    /**
     * Get a list of all the records for a user.
     * @return bool|\mysqli_result Return a list of all the records for a user.
     */
    public function toListUser()
    {
        $sql = "SELECT C.*, I.quantity ,I.totalPrice, P.name as name_product, P.image as image_product 
          FROM carts C 
          INNER JOIN itemsCart I 
          on C.id=I.idCart and C.paidOut=false and C.idUser='{$this->cart->getIdUser()}' 
          INNER JOIN products P on P.id=I.idProduct ";
        $data = $this->conection->ReturnQuery($sql);
        $rows = mysqli_fetch_assoc($data);
        return $rows;
    }
    
    /**
     * View user's unpaid registration.
     * @return array|null Return an arrangement with the record.
     */
    public function findByUser()
    {
        $sql = "SELECT C.* 
          FROM carts C 
          where C.paidOut=false and C.id='{$this->cart->getId()}' and C.idUser='{$this->cart->getIdUser()}'";
        $data = $this->conection->ReturnQuery($sql);
        $rows = mysqli_fetch_assoc($data);
        return $rows;
    }

    /**
     * Generates a list to show all the items in a cart for a specific user.
     * @return bool|\mysqli_result
     */
    public function toListItemsCart()
    {
        $sql = "SELECT C.*, I.id as idItem, I.quantity ,I.totalPrice, P.name as name_product, P.image as image_product 
	      FROM carts C 
	      INNER JOIN itemsCart I 
	      on C.id=I.idCart and C.paidOut=false and C.id='{$this->cart->getId()}' and C.idUser='{$this->cart->getIdUser()}' 
	      INNER JOIN products P 
	      on P.id=I.idProduct ";
        $data = $this->conection->ReturnQuery($sql);
        $rows = mysqli_fetch_assoc($data);
        return $rows;
    }
    
    /**
     * Add a register
     */
    public function add()
    {
        $sql = "INSERT INTO carts(id, idUser, totalPrice, direction, paidOut, creationDate) 
                VALUES(NULL, '{$this->cart->getIdUser()}', '{$this->cart->getTotalPrice()}', '{$this->cart->getDirection()}', 
                '{$this->cart->getPaidOut()}', NOW());";
        $data = $this->conection->InsertQuery($sql);
        return $data;
    }
    
    /**
     * @inheritDoc
     */
    public function edit()
    {
        $sql = "update carts set totalPrice='{$this->cart->getTotalPrice()}', direction='{$this->cart->getDirection()}', paidOut='{$this->cart->getPaidOut()}' where id='{$this->cart->getId()}';";
        $this->conection->SimpleQuery($sql);
    }
    
    /**
     * View a register.
     * @return array|null Return an arrangement with the record. 
     */
    public function view()
    {
        $sql = "SELECT * FROM carts WHERE id='{$this->cart->getId()}'";
        $data = $this->conection->ReturnQuery($sql);
        setCart(mysqli_fetch_assoc($data));
        return $this->cart;
    }
    
    /**
     * @inheritDoc
     */
    public function delete()
    {
        $sql = "delete from carts where id='{$this->cart->getId()}';";
        $this->conection->SimpleQuery($sql);
    }
    
    /**
     * View a register not paid out.
     * @return array|null Return an arrangement with the record.
     */
    public function viewNotPaidout()
    {
        $sql = "SELECT * FROM carts WHERE idUser='{$this->cart->getIdUser()}' and paidOut=false ";
        $data = $this->conection->ReturnQuery($sql);
        $row = mysqli_fetch_assoc($data);
        return $row;
    }
    
    /**
     * @param array $dataCart Array of data.
     */
    private function setCart($dataCart): void
    {
        if(isset($dataCart))
        {
            $this->cart->setId($dataCart['id']);
            $this->cart->setIdUser($dataCart['idUser']);
            $this->cart->setTotalPrice($dataCart['totalPrice']);
            $this->cart->setDirection($dataCart['direction']);
            $this->cart->setPaidOut($dataCart['paidOut']);
            $this->cart->setCreationDate($dataCart['creationDate']);
        }
    }
}
