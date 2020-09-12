<?php

namespace Test\Models;

use Models\Conection;
use Models\Users;
use PHPUnit\Framework\TestCase;

class ConectionTest extends TestCase
{
    private string $sql;
    private string $mensaje;
    private Users $user;
    private Conection $conexion;

    /**
     * Test for method SimpleQuery with return not null.
     */
    public function testSimpleQuery_WithSQLValid_ShouldNotNull():void
    {
        $this->sql = "select * from users;";
        $resultado = $this->conexion->SimpleQuery($this->sql);
        $this->assertNotNull($resultado);
    }

    /**
     * Test for method SimpleQuery with return null.
     */
    public function testSimpleQuery_WithSQLNotValid_ShouldNull():void
    {
        $this->sql = "update users set firstName='pruebas' where id=1;";
        $resultado = $this->conexion->SimpleQuery($this->sql);
        $this->assertNull($resultado);
    }

    /**
     * Test for method SimpleQuery with return not null.
     */
    public function testReturnQuery_WithSQLValid_ShouldNotNull():void
    {
        $this->sql = "select * from products;";
        $resultado = $this->conexion->ReturnQuery($this->sql);
        $this->assertNotNull($resultado);
    }

    public function testInsertQuery()
    {
        $this->mensaje = "Error al insertar un registro.";
        $this->sql = "INSERT INTO users(firstName, lastName, email, login, password, creationDate) "
            . "VALUES('{$this->user->getFirstName()}', '{$this->user->getLastName()}', '"
            . "{$this->user->getEmail()}', '{$this->user->getLogin()}', '{$this->user->getPassword()}', NOW());";
        $result = $this->conexion->InsertQuery($this->sql);
        $this->assertGreaterThan(0, $result, $this->mensaje);
    }

    public function testClose()
    {

    }

    public function test__construct()
    {
        $this->mensaje = "Error al crear la instancia.";
        $this->assertInstanceOf(Conection::class, new Conection(), $this->mensaje);
    }

    public function testReturnQuery()
    {

    }
}
