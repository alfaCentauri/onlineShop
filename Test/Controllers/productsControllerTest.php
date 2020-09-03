<?php

namespace Test\Controllers;

use Models\Conection as Conection;
use PHPUnit\Framework\TestCase;

class productsControllerTest extends TestCase
{
    private string $mensaje;

    public function testCanBeCreated__construct(): void
    {
        $this->mensaje = "Error al crear la conexión.";
        $this->assertInstanceOf(Conection::class, new Conection(), $this->mensaje);
    }

    public function testIndex()
    {
        $this->mensaje = "";
    }

    public function testRemove()
    {

    }

    public function testEdit()
    {

    }

    public function testAdd()
    {

    }

    public function testView()
    {

    }

    public function testUpdate()
    {

    }
}
