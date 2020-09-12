<?php

namespace Test\Controllers;

use Controllers\productsController;
use PHPUnit\Framework\TestCase;

class productsControllerTest extends TestCase
{
    private string $mensaje;
    private productsController $controlador;

    public function testCanBeCreated__construct():void
    {
        $this->mensaje = "Error al crear la instancia.";
        $this->assertInstanceOf(productsController::class, new productsController(), $this->mensaje);
    }

    public function testCanBeCreatedArrayIndex():void
    {
        $this->mensaje = "No se crea el arreglo de datos.";
        $this->controlador = new productsController();
        $this->assertIsArray($this->controlador->index(), $this->mensaje);
    }

    /**
     * @dataProvider additionProvider
     */
    public function testWhenMethodGetAdd()
    {
        $this->mensaje = "No se pueden agregar los datos.";
        $this->controlador = new productsController();
        $this->callback(); // Revisar
        //$this->call('Get', 'add'); // no existe
        //$this->assertResponseOk(); // no existe
    }

    public function additionProvider()
    {
        return [
            'id'    => 100,
            'name'  => "ejemplo 1",
            'price' => 1.45,
            'stock' => 25
        ];
    }

    public function testEdit()
    {

    }

    public function testView()
    {

    }

    public function testUpdate()
    {

    }

    public function testRemove()
    {
        $this->mensaje = "No se puede borrar los datos.";
    }
}
