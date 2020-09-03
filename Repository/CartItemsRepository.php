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

use Models\CartItems;
/**
 * Repository of Class CartItems.
 *
 * @package Repository.
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 1.1.
 */
class CartItemsRepository extends Repository
{
    private CartItems $cartItem;
    
    public function __construct(CartItems $cartItem)
    {
        $this->cartItem = $cartItem;
    }
    
    /**
     * @inheritDoc
     */
    public function all()
    {
        $sql = "SELECT * FROM itemsCart;";
        $data = $this->conection->ReturnQuery($sql);
        return $data;
    }
    
    /**
     * @inheritDoc
     */
    public function find(int $id)
    {
        $sql = "SELECT * FROM itemsCart where id='{$id}'";
        $data = $this->conection->ReturnQuery($sql);
        $row = mysqli_fetch_assoc($data);
        return $row;
    }

    /**
     * @inheritDoc
     */
    public function findBy(String $param, String $value)
    {
        $sql = "SELECT * FROM itemsCart where {$param}='{$value}'";
        $data = $this->conection->ReturnQuery($sql);
        $row = mysqli_fetch_assoc($data);
        return $row;
    }

    /**
     * @inheritDoc
     */
    public function orderBy(string $param, string $order = 'ASC')
    {
        $sql = "SELECT * FROM itemsCart ORDER BY {$param} '{$order}'";
        $data = $this->conection->ReturnQuery($sql);
        return $data;
    }
    
    /**
     * @inheritDoc
     */
    public function add()
    {
        $sql = "INSERT INTO itemsCart(id, idCart, idProduct, quantity, totalPrice)
            VALUES(NULL, '{$this->cartItem->getIdCart()}', '{$this->cartItem->getIdProduct()}', 
            '{$this->cartItem->getQuantity()}', '{$this->cartItem->getTotalPrice()}');";
        $this->conection->SimpleQuery($sql);
    }
    
    /**
     * @inheritDoc
     */
    public function edit()
    {
        $sql = "update itemsCart set 
            quantity='{$this->cartItem->getQuantity()}', 
            totalPrice='{$this->cartItem->getTotalPrice()}' 
            where id='{$this->cartItem->getId()}';";
        $this->conection->SimpleQuery($sql);
    }
    
    /**
     * View register.
     * @return array|null Return an arrangement with the record.
     */
    public function view()
    {
        $sql = "SELECT I.*, P.name as name_product, P.image as image_product, P.stock as stock 
          FROM itemsCart I 
          INNER JOIN products P 
          on I.idProduct=P.id and I.id='{$this->cartItem->getId()}';";
        $data = $this->conection->ReturnQuery($sql);
        $row = mysqli_fetch_assoc($data);
        return $row;
    }
    
    /**
     * Delete record indicated by the current id.
     */
    public function delete()
    {
        $sql = "delete from itemsCart where id='{$this->cartItem->getId()}';";
        $this->conection->SimpleQuery($sql);
    }
    
    /**
     * Get a list of all records with the image and the name of the associated
     * product.
     */
    public function toList2()
    {
        $sql = "SELECT T1.*, T2.name as name_product, T2.image as image_product FROM itemsCart T1 
            INNER JOIN products T2 on T1.idProduct=T2.id ;";
        $data = $this->conection->ReturnQuery($sql);
        $rows = mysqli_fetch_assoc($data);
        return $rows;
    }
    
    /**
     * Get the total of all the records for a cart.
     */
    public function totalList()
    {
        $sql = "SELECT sum(T1.totalPrice) as subtotal FROM itemsCart T1 where T1.idCart='{$this->cartItem->getIdCart()}';";
        $data = $this->conection->ReturnQuery($sql);
        $row = mysqli_fetch_assoc($data);
        return $row;
    }
}
