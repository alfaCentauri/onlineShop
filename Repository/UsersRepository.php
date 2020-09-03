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

use Models\Users;

/**
 * Repository of Class Users.
 *
 * @package Repository
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 1.1.
 */
class UsersRepository extends Repository
{
    private Users $user;
    
    public function __construct(Users $user)
    {
        $this->user = $user;
    }
    
    /**
     * @inheritDoc
     */
    public function all()
    {
        $sql = "SELECT * FROM users;";
        $data = $this->conection->ReturnQuery($sql);
        return $data;
    }
    
    /**
     * @inheritDoc
     */
    public function find(int $id)
    {
        $sql = "SELECT * FROM users where id='{$id}';";
        $data = $this->conection->ReturnQuery($sql);
        $row = mysqli_fetch_assoc($data);
        return $row;
    }
    
    /**
     * @inheritDoc
     */
    public function findBy(String $param, String $value)
    {
        $sql = "SELECT * FROM users where '{$param}'='{$value}';";
        $data = $this->conection->ReturnQuery($sql);
        $row = mysqli_fetch_assoc($data);
        return $row;
    }
    
    /**
     * @inheritDoc
     */
    public function orderBy(string $param, string $order = 'ASC')
    {
        $sql = "SELECT * FROM users ORDER BY {$param} '{$order}';";
        $data = $this->conection->ReturnQuery($sql);
        return $data;
    }
    
    /**
     * @inheritDoc
     */
    public function add()
    {
        $sql = "INSERT INTO users(firstName, lastName, email, login, password, creationDate) "
                . "VALUES('{$this->user->getFirstName()}', '{$this->user->getLastName()}', '"
                . "{$this->user->getEmail()}', '{$this->user->getLogin()}', '{$this->user->getPassword()}', NOW());";
        $this->conection->SimpleQuery($sql);
    }
    
    /**
     * @inheritDoc
     */
    public function delete()
    {
        $sql = "delete from users where id='{$this->user->getId()}';";
        $this->conection->SimpleQuery($sql);
    }
    
    /**
     * @inheritDoc
     */
    public function edit()
    {
        $sql = "update users set firstName = '{$this->user->getFirstName()}', lastName = "
        . "'{$this->user->getLastName()}', email = '{$this->user->getEmail()}', login = '{$this->user->getLogin()}', '"
        . "{$this->user->getPassword()}' where id = '{$this->user->getId()}';";
        $this->conection->SimpleQuery($sql);
    }
    
    /**
     * @inheritDoc
     */
    public function view()
    {
        $sql = "SELECT * FROM users where id='{$this->user->getId()}'";
        $data = $this->conection->ReturnQuery($sql);
        $row = mysqli_fetch_assoc($data);
        return $row;
    }
    
}
