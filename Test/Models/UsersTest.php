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
namespace TestModels;

use Models\Users;
/**
 * Test of Class Users.
 *
 * @package TestModels
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 1.1.
 */
class UsersTest extends \PHPUnit_Framework_TestCase
{
    private Users $usuario;

    public function setUp(){
        $this->usuario = new Users();
    }

    public function testSetLogin_WithString_ShouldString()
    {
        $texto = "login";
        $this->usuario->setLogin($texto);
        $this->asserEquals($texto, $this->usuario->getLogin());
    }

    public function testSetLogin_WithEmpty_ShouldEmpty()
    {
        $texto = "";
        $this->usuario->setLogin($texto);
        $this->asserEquals($texto, $this->usuario->getLogin());
    }

    public function testSetLogin_WithNull_ShouldNull()
    {
        $texto = null;
        $this->usuario->setLogin($texto);
        $this->asserNull($this->usuario->getLogin());
    }

    public function testSetFirstName_WithString_ShouldString()
    {
        $name = "Usuario";
        $this->usuario->setFirstName($name);
        $this->assertEquals($name, $this->usuario->getFirstName());
    }

    public function testSetFirstName_WithEmpty_ShouldEmpty()
    {
        $name = "";
        $this->usuario->setFirstName($name);
        $this->assertEquals($name, $this->usuario->getFirstName());
    }

    public function testSetFirstName_WithNull_ShouldNull()
    {
        $name = null;
        $this->usuario->setFirstName($name);
        $this->assertNull($this->usuario->getFirstName());
    }

    public function testSetLastName_WithString_ShouldString()
    {
        $lastName = "Pruebas";
        $this->usuario->setLastName($lastName);
        $this->assertEquals($lastName, $this->usuario->getLastName());
    }

    public function testSetLastName_WithEmpty_ShouldEmpty()
    {
        $lastName = "";
        $this->usuario->setLastName($lastName);
        $this->assertEquals($lastName, $this->usuario->getLastName());
    }

    public function testSetLastName_WithNull_ShouldNull()
    {
        $lastName = null;
        $this->usuario->setLastName($lastName);
        $this->assertNull($this->usuario->getLastName());
    }

    public function testSetEmail_WithEmail_ShouldEmail()
    {
        $email = "correo@dominio.com";
        $this->usuario->setEmail($email);
        $this->assertEquals($email, $this->usuario->getEmail());
    }

    public function testSetEmail_WithEmpty_ShouldEmpty()
    {
        $email = "";
        $this->usuario->setEmail($email);
        $this->assertEquals($email, $this->usuario->getEmail());
    }

    public function testSetEmail_WithNull_ShouldNull()
    {
        $email = null;
        $this->usuario->setEmail($email);
        $this->assertNull($this->usuario->getEmail());
    }

    public function testSetPassword_WithNull_ShouldNull()
    {
        $password = null;
        $this->usuario->setPassword($password);
        $this->assertNull($this->usuario->getPassword());
    }

    public function testSetPassword_WithEmpty_ShouldEmpty()
    {
        $password = "";
        $this->usuario->setPassword($password);
        $this->assertEquals($password, $this->usuario->getPassword());
    }

    public function testSetPassword_WithString_ShouldString()
    {
        $password = "clavepruebas123";
        $this->usuario->setPassword($password);
        $this->assertEquals($password, $this->usuario->getPassword());
    }

    public function testGetLastName()
    {
        $this->assertEquals("", $this->usuario->getLastName());
    }

    public function testGetFirstName()
    {
        $this->assertEquals("", $this->usuario->getFirstName());
    }

    public function testGetPassword()
    {
        $this->assertEquals("", $this->usuario->getPassword());
    }

    public function testGetEmail()
    {
        $this->assertEquals("", $this->usuario->getEmail());
    }

    public function testGetLogin()
    {
        $this->assertEquals("", $this->usuario->getLogin());
    }

}
