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
 * This is the qualification of the product.
 *
 * @package Models
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 2.0.
 */
class Qualification extends Entity
{
    /**
     * It contains the index of the user.
     * @var int
     */
    private int $idUser;
    /**
     * It contains the index of the product.
     * @var int
     */
    private int $idProduct;
    /**
     * It contains the points del product.
     * @var int
     */
    private int $points;
    
    /**
     * Qualification constructor.
     */
    function __construct()
    {
        $this->id = 0;
        $this->creationDate = "";
        $this->active = true;
        $this->idUser = 0;
        $this->idProduct = 0;
        $this->points = 0;
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

}
