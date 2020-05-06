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

namespace Models;

/**
 * Description of Cart
 *
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 2.0.
 */
class Cart extends Entity
{
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
     * Cart constructor.
     */
    function __construct()
    {
        $this->id = 0;
        $this->creationDate = "";
        $this->active = true;
        $this->idUser = 0;
        $this->direction ="";
        $this->totalPrice = 0;
        $this->paidOut = false;
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
     * @return bool
     */
    public function isPaidOut(): bool
    {
        return $this->paidOut;
    }

    /**
     * @param bool $paidOut
     */
    public function setPaidOut(bool $paidOut): void
    {
        $this->paidOut = $paidOut;
    }

}
