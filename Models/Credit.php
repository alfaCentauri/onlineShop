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

/***
 * Class Credit.
 *
 * @package Models.
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 2.0.
 */
class Credit extends Entity
{
    /**
     * Contains the index of user.
     * @var int
     */
    private $idUser;
    /**
     * Contains the balance of credit.
     * @var float
     */
    private $balance;

    /**
     * Credit constructor.
     */
    public function __construct()
    {
        $this->id = 0;
        $this->creationDate = "";
        $this->active = true;
        $this->idUser = 0;
        $this->balance = 0;
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
     * @return mixed
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param mixed $balance
     */
    public function setBalance($balance): void
    {
        $this->balance = $balance;
    }

}
