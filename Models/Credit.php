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

/***
 * Class Credit.
 *
 * @package Models.
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 1.0.
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
        $this->idUser = 0;
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

    /**
     * Display a record indicated by the current id.
     * @return array|null Return the register if found else return null.
     */
    public function view()
    {
        $sql = "SELECT * FROM credit where id='{$this->id}'";
        $data = $this->conn->ReturnQuery($sql);
        $row = mysqli_fetch_assoc($data);
        return $row;
    }

    /**
     * Add a register
     * @return int Return a integer with last id of credit.
     */
    public function add()
    {
        $sql = "INSERT INTO credit(id, idUser, balance, creationDate) 
          VALUES(null, '{$this->idUser}', '{$this->balance}', NOW());";
        $lastId=$this->conn->InsertQuery($sql);
        return $lastId;
    }

    /**
     * Edit record indicated by the current id.
     */
    public function edit()
    {
        $sql = "UPDATE credit SET balance='{$this->balance}' where id='{$this->id}';";
        $this->conn->SimpleQuery($sql);
    }

    /**
     * Delete record indicated by the current id.
     */
    public function delete()
    {
        $sql = "delete from credit where id='{$this->id}';";
        $this->conn->SimpleQuery($sql);
    }

    /**
     * Get a list of all the records.
     * @return mixed
     */
    public function toList()
    {
        $sql = "select * from credit;";
        $data = $this->conn->ReturnQuery($sql);
        return $data;
    }
    /**
     * Display a record indicated by the current index user.
     * @return array|null Return the register if found else return null.
     */
    public function findByUser()
    {
        $sql = "SELECT * FROM credit where idUser='{$this->idUser}'";
        $data = $this->conn->ReturnQuery($sql);
        $row = mysqli_fetch_assoc($data);
        return $row;
    }
}