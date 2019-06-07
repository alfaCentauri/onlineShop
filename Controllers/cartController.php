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

namespace Controllers;

use Models\Cart as Cart;
use Models\Product as Product;
/**
 * Description of cartController
 *
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 1.0.
 */
class cartController 
{
    /**
     * Contains a object of type Cat.
     */
    private $cart;
    /**
     * Contains a object of type Product.
     */
    private $product;
    /**
     * @var float
    */
    private $subtotal;
    /**
     * Construct
     **/
    function __construct() 
    {
        $this->cart = new Cart();
        $this->product = new Product();
        $this->subtotal = 0.0;
    }
    /**Default*/
    public function index(int $id=1)
    {
        $this->cart->setIdUser($id);
        $data = $this->cart->toListUser();
        return $data;
    }
    /**List all product carts.*/
    public function toListAll()
    {
        $data = $this->cart->toList();
        return $data;
    }

    /**
     * Add the product to the user's cart with the indicated amount and discount
     * the stock. Go back to the list of products.
     * @param int $id Default 0.
     */
    public function add($id=0)
    {
        $this->product->setId($id);
        $data = $this->product->view();
        $this->cart->setIdUser(1);
        $this->cart->setIdProduct($data['id']);
        if ($_POST)
        {
            $quantity = $_POST['quantity'];
            $this->cart->setQuantity($quantity);
            $this->cart->setTotalPrice($data["price"]*$quantity);
            $result = $data['stock'] - $this->cart->getQuantity();
            $this->product->setStock($result);
            $this->product->setId($data['id']);
            $this->product->setName($data['name']);
            $this->product->setPrice($data["price"]);
            $this->product->setImage($data['image']);
            $this->product->setCreationDate($data['creationDate']);
            $this->product->edit();
            //
            $this->cart->add();
            header("Location: ".URL."index.php?url=cart");
        }
        return $data;
    }

    /**
     * Preview of the cart.
     * @param $id   Integer integer.
     */
    public function preview($id)
    {
        $this->product->setId($id);
        $data = $this->product->view();
        return $data;
    }

    /**
     * Show a cart.
     * @param $id   Integer integer.
     * @return array|null   $id.
     */
    public function view($id):array
    {
        $this->cart->setId($id);
        $data = $this->cart->view();
        return $data;
    }

    /**
     * Show the form for the shipment of the products and request the type of
     * shipment.
     * @param int $id     Default 1.
     * @return array|null   $data
     */
    public function shipping(int $id=1)
    {
        $this->cart->setId($id);
        $this->cart->setIdUser(1);  //Debug
        $data = $this->cart->toListUser();
        if (!is_null($data))
        {
            $array = $this->cart->totalList();
            $filed = $array->fetch_assoc();
            $this->subtotal = $filed['subtotal'];
        }
        return $data;
    }

    /**
     * @param int $id   Default 0.
     */
    public function dispach(int $id=0)
    {
        echo 'Despacho muestra direccion de envio y fin';
    }

    /**
     * @return float
     */
    public function getSubtotal(): float
    {
        return $this->subtotal;
    }

    /**
     * @param float $subtotal
     */
    public function setSubtotal(float $subtotal): void
    {
        $this->subtotal = $subtotal;
    }
    /**
     * @param int $id Indice del registro.
    */
    public function edit(int $id=1)
    {
        $this->cart->setId($id);
        print 'El idU: '.$this->cart->getIdUser();
        $data = $this->cart->view();
        return $data;
    }
}
//
$cart = new cartController();
