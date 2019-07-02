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
 * Description of Users.
 *
 * @package Models
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 1.0.
 */
class Users implements Crud
{
    /**
     * It contains the index.
     * @var int
     */
    private $id;
    /**
     * Contains the firstName
     * @var string
     */
    private $firstName;
    /**
     * Contains the lastName
     * @var string
     */
    private $lastName;
    /**
     * User email
     * @var string
     */
    private $email;
    /**
     * User Login
     * @var string
    */
    private $login;
    /**
     * Encrypted user password
     * @var string
    */
    private $password;
    /**
     * @var Boolean
     */
    private $active;
    /**
     * Contains creation date.
     * @var mixed
     */
    private $creationDate;
    /**
     * Conetion to DB.
     * @var Conection
     */
    private $conection;
    /***/
    function __construct() 
    {
        $this->id=0;
        $this->firstName="";
        $this->lastName="";
        $this->email="";
        $this->login="";
        $this->password="";
        $this->active=true;
    }
    /**List**/
    public function toList()
    {
        $sql = "SELECT * FROM users;";
        $data = $this->conection->ReturnQuery($sql);
        return $data;
    }
    /**Add register*/
    public function add()
    {
        $sql = "INSERT INTO users(firstName, lastName, email, login, password, creationDate) "
                . "VALUES('{$this->firstName}', '{$this->lastName}', '"
                . "{$this->email}', '{$this->login}', '{$this->password}', NOW());";
        $this->conection->SimpleQuery($sql);
    }
    /**Delete record indicated by the current id.*/
    public function delete()
            {
        $sql = "delete from users where id='{$this->id}';";
        $this->conection->SimpleQuery($sql);
    }
    /**Edit record indicated by the current id.*/
    public function edit()
    {
        $sql = "update users set firstName='{$this->firstName}', lastName="
        . "'{$this->lastName}', email='{$this->email}', login='{$this->login}', '"
        . "{$this->password}' where id='{$this->id}';";
        $this->conection->SimpleQuery($sql);
    }
    /**Display a record indicated by the current id.*/
    public function view()
    {
        $sql = "SELECT * FROM users where id='{$this->id}'";
        $datos = $this->conection->ReturnQuery($sql);
        $row = mysqli_fetch_assoc($datos);
        return $row;
    }
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param mixed $creationDate
     */
    public function setCreationDate($creationDate): void
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return Conection
     */
    public function getConection(): Conection
    {
        return $this->conection;
    }

    /**
     * @param Conection $conection
     */
    public function setConection(Conection $conection): void
    {
        $this->conection = $conection;
    }

}
