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

use Models\Credit;
use phpDocumentor\Reflection\Types\Integer;
/**
 * Repository of Class Credit.
 *
 * @package Repository.
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 1.1.
 */
class CreditRepository extends Repository
{
    /**
     * Object credit for use data.
    */
    private Credit $credit;

    public function __construct(Credit $credit)
    {
        $this->credit = $credit;
    }
    
    /**
     * @inheritDoc
     */
    public function all()
    {
        $sql = "SELECT * FROM credit;";
        $data = $this->conection->ReturnQuery($sql);
        $rows = mysqli_fetch_assoc($data);
        return $rows;
    }
    
    /**
     * @inheritDoc
     */
    public function find(Integer $id)
    {
        $sql = "SELECT * FROM credit where id='{$id}'";
        $data = $this->conection->ReturnQuery($sql);
        setCredit(mysqli_fetch_assoc($data));
        return $this->credit;
    }

    /**
     * @inheritDoc
     */
    public function findBy(String $param, String $value)
    {
        $sql = "SELECT * FROM credit where {$param}='{$value}'";
        $data = $this->conection->ReturnQuery($sql);
        $row = mysqli_fetch_assoc($data);
        return $row;
    }

    /**
     * @inheritDoc
     */
    public function orderBy(String $param, String $order = "ASC")
    {
        $sql = "SELECT * FROM credit ORDER BY {$param} '{$order}'";
        $data = $this->conection->ReturnQuery($sql);
        $rows = mysqli_fetch_assoc($data);
        return $rows;
    }
    
    /**
     * Display a record indicated by the current index user.
     * @return array|null Return the register if found else return null.
     */
    public function findByUser()
    {
        $sql = "SELECT * FROM credit where idUser='{$this->credit->getIdUser()}'";
        $data = $this->conection->ReturnQuery($sql);
        setCredit(mysqli_fetch_assoc($data));
        return $this->credit;
    }
    
    /**
     * Add a register.
     * @return int Return a integer with last id of credit.
     */
    public function add()
    {
        $sql = "INSERT INTO credit(id, idUser, balance, creationDate) 
          VALUES(null, '{$this->getIdUser()}', '{$this->getBalance()}', NOW());";
        $lastId=$this->conection->InsertQuery($sql);
        return $lastId;
    }
    
    /**
     * @inheritDoc
     */
    public function edit()
    {
        $sql = "UPDATE credit SET balance='{$this->getBalance()}' where id='{$this->getId()}';";
        $this->conection->SimpleQuery($sql);
    }
    
    /**
     * @inheritDoc
     */
    public function view()
    {
        $sql = "SELECT * FROM credit where id='{$this->getId()}'";
        $data = $this->conection->ReturnQuery($sql);
        setCredit(mysqli_fetch_assoc($data));
        return $this->credit;
    }
    
    /**
     * @inheritDoc
     */
    public function delete()
    {
        $sql = "delete from credit where id='{$this->getId()}';";
        $this->conection->SimpleQuery($sql);
    }

    /**
     * @param array $dataCredit Array of data.
     */
    private function setCredit($dataCredit):void
    {
        if(isset($dataCredit))
        {
            $this->credit->setId($dataCredit['id']);
            $this->credit->setIdUser($dataCredit['idUser']);
            $this->credit->setBalance($dataCredit['balance']);
            $this->credit->setCreationDate($dataCredit['creationDate']);
        }
    }
}
