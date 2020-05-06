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

/**
 * Class CartItems.
 *
 * @package Models
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 2.0.
 */
class CartItems extends Entity
{
    /**
     * Contains the index of the cart.
     * @var int
    */
    private $idCart;
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
     * CartItems constructor.
     */
    public function __construct()
    {
        $this->id = 0;
        $this->creationDate = "";
        $this->active = true;
        $this->idCart = 0;
        $this->idProduct = 0;
        $this->quantity = 0;
        $this->totalPrice = 0;
    }

    /**
     * @return int
     */
    public function getIdCart(): int
    {
        return $this->idCart;
    }

    /**
     * @param int $idCart
     */
    public function setIdCart(int $idCart): void
    {
        $this->idCart = $idCart;
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
    
}
