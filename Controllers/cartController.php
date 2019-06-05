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
        $data = $this->preview($id);
        $this->cart->setIdUser(1);
        $this->cart->setIdProduct($data['id']);
        $quantity = $_POST['quantity'];
        /*print '<br>Cantidad: '.$quantity.'<br>';  //Debug*/
        $this->cart->setQuantity($quantity);
        $this->cart->setTotalPrice($data["price"]*$quantity);
        $result = $data['stock'] - $this->cart->getQuantity();
        $this->product->setStock($result);
        /*print '<br>';  //Debug
        var_dump($this->cart);  //Debug
        print '<br>';  //Debug
        var_dump($this->product);  //Debug
        print '<br>';  //Debug*/
        //
        $this->product->setId($data['id']);
        $this->product->setName($data['name']);
        $this->product->setPrice($data["price"]);
        $this->product->setImage($data['image']);
        $this->product->setCreationDate($data['creationDate']);
        $this->product->edit();
        //
        $this->cart->add();
        /*header("Location: ".URL."index.php?url=cart");*/
    }

    /**
     * Preview of the product.
     * @param $idProduct   Integer integer.
     * @return array|null   $idProduct.
     */
    public function preview($idProduct):array
    {
        $this->product->setId($idProduct);
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
        $this->product->setId($id);
        $data = $this->product->view();
        return $data;
    }
}
