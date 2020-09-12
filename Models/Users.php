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
 * Description of Users.
 *
 * @package Models
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 2.0.
 */
class Users extends Entity
{
    /**
     * Contains the firstName
     * @var string
     */
    private string $firstName;
    /**
     * Contains the lastName
     * @var string
     */
    private string $lastName;
    /**
     * User email
     * @var string
     */
    private string $email;
    /**
     * User Login
     * @var string
    */
    private string $login;
    /**
     * Encrypted user password
     * @var string
    */
    private string $password;

    /**
     * Construct of the class
     */
    function __construct() 
    {
        $this->id = 0;
        $this->creationDate = "";
        $this->active = true;
        $this->firstName = "";
        $this->lastName = "";
        $this->email = "";
        $this->login = "";
        $this->password = "";
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

}
