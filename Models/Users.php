<?php

/*
 * Copyright (C) 2019 ricardo
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
 * Description of Users
 *
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 1.0.
 */
class Users implements Crud
{
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $login;
    private $password;
    private $active;
    private $creationDate;
    private $conn;
    /***/
    function __construct() 
    {
        $this->conn=new Conection();
    }
    /**List**/
    public function toList()
    {
        $sql = "SELECT * FROM users;";
        $data = $this->conn->ReturnQuery($sql);
        return $data;
    }
    /**Add register*/
    public function add()
    {
        $sql = "INSERT INTO users(firstName, lastName, email, login, password, creationDate) "
                . "VALUES('{$this->firstName}', '{$this->lastName}', '"
                . "{$this->email}', '{$this->login}', '{$this->password}', NOW());";
        $this->conn->SimpleQuery($sql);
    }
    /**Delete record indicated by the current id.*/
    public function delete()
            {
        $sql = "delete from users where id='{$this->id}';";
        $this->conn->SimpleQuery($sql);
    }
    /**Edit record indicated by the current id.*/
    public function edit()
    {
        $sql = "update users set firstName='{$this->firstName}', lastName="
        . "'{$this->lastName}', email='{$this->email}', login='{$this->login}', '"
        . "{$this->password}' where id='{$this->id}';";
        $this->conn->SimpleQuery($sql);
    }
    /**Display a record indicated by the current id.*/
    public function view()
    {
        $sql = "SELECT * FROM users where id='{$this->id}'";
        $datos = $this->conn->ReturnQuery($sql);
        $row = mysqli_fetch_assoc($datos);
        return $row;
    }
    /***/
    function getId() 
    {
        return $this->id;
    }

    function getFirstName() 
    {
        return $this->firstName;
    }

    function getLastName() 
    {
        return $this->lastName;
    }

    function getEmail() 
    {
        return $this->email;
    }

    function getLogin() 
    {
        return $this->login;
    }

    function getPassword() 
    {
        return $this->password;
    }

    function getActive() 
    {
        return $this->active;
    }

    function getCreationDate() 
    {
        return $this->creationDate;
    }

    function getConn() 
    {
        return $this->conn;
    }

    function setId($id) 
    {
        $this->id = $id;
    }

    function setFirstName($firstName) 
    {
        $this->firstName = $firstName;
    }

    function setLastName($lastName) 
    {
        $this->lastName = $lastName;
    }

    function setEmail($email) 
    {
        $this->email = $email;
    }

    function setLogin($login) 
    {
        $this->login = $login;
    }

    function setPassword($password) 
    {
        $this->password = $password;
    }

    function setActive($active) 
    {
        $this->active = $active;
    }

    function setCreationDate($creationDate) 
    {
        $this->creationDate = $creationDate;
    }

    function setConn($conn) 
    {
        $this->conn = $conn;
    }

}
