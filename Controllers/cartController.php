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
     * Construct
     **/
    function __construct() 
    {
        $this->cart = new Cart();
        $this->product = new Product();
    }
    /**Default*/
    public function index()
    {
        $data = $this->cart->toList2();
        return $data;
    }
    /**
     * Add the product to the user's cart with the indicated amount and discount 
     * the stock. Go back to the list of products.
     */
    public function add()
    {
        $this->cart->setIdProduct($this->product->getId());
        $this->cart->setIdUser(1);
        $this->cart->setQuantity($_POST['quantity']);
        $result = $this->product->getStock()-$this->cart->getQuantity();
        $this->product->setStock($result);
        $this->product->edit();
        $this->cart->add();
        header("Location: ".URL."index.php?url=products");
    }
    /**
     * Preview
     * @param $idProduct   Integer integer.
     */
    public function preview($idProduct)
    {
        $this->product->setId($idProduct);
        $data = $this->product->view();
        return $data;
    }
    /**
     * Show a cart.
     * @param $id   Integer integer.
     */
    public function view($id)
    {
        $this->product->setId($id);
        $data = $this->product->view();
        return $data;
    }
}
