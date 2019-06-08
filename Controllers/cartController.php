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
use Models\CartItems;
use Models\Product as Product;
use Models\Users;

/**
 * Description of cartController
 *
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 1.0.
 */
class cartController implements Crud
{
    /**
     * Contains a object of type Users.
     * @var Users
     **/
    private $user;
    /**
     * Contains a object of type Cat.
     */
    private $cart;
    /**
     * Contains a object of type Product.
     */
    private $product;
    /**
     * Contains the data of the cart items.
     * @var CartItems
     */
    private $itemsCart;
    /**
     * @var float
    */
    private $subtotal;
    /**
     * @var String
     */
    private $direction;
    /**
     * Construct
     **/
    function __construct() 
    {
        $this->cart = new Cart();
        $this->product = new Product();
        $this->itemsCart = new CartItems();
        $this->subtotal = 0.0;
        $this->direction = "";
    }

    /**Default
     * @param int $id
     * @return bool|\mysqli_result  Data of list of the cart.
     */
    public function index(int $idCart=1, int $idU=1)
    {
        $this->cart->setIdUser($idU);
        $data = $this->cart->toListUser();
        return $data;
    }
    /**
     * Gets the user's full name.
     * @param int $idU
     * @return null|string
     */
    public function getUserName(int $idU=0)
    {
        if ($idU>0)
        {
            $this->user->setId($idU);
            $data_users = $this->user->view();
            return $data_users['firstName']." ".$data_users['lastName'];
        }
        return null;
    }
    /**List all product carts.*/
    public function all()
    {
        $data = $this->cart->toList();
        return $data;
    }

    /**
     * Add the product to the user's cart with the indicated amount and discount
     * the stock. Go back to the list of products.
     * First check if the shopping cart exists; then add the items to the cart. If it does not exist, a new one is
     * created.
     * The route to add to the cart will be:
     * http://localhost/onlineShop/cart/add/$id/$idU/$idCart .
     *
     * @param int $id Default 0.
     * @param int $idU Default 1.
     * @param int $idCart Default 1.
     * @return array|null Data of product.
     */
    public function add(int $id=0, int $idU=1, int $idCart=1)
    {
        $this->product->setId($id);
        $data = $this->product->view();
        $this->cart->setIdUser($idU);
        $this->itemsCart->setIdProduct($data['id']);
        if ($_POST)
        {
            $quantity = $_POST['quantity'];
            $this->itemsCart->setQuantity($quantity);
            $this->itemsCart->setTotalPrice($data["price"]*$quantity);
            $result = $data['stock'] - $this->itemsCart->getQuantity();
            $this->product->setStock($result);
            $this->product->setId($data['id']);
            $this->product->setName($data['name']);
            $this->product->setPrice($data["price"]);
            $this->product->setImage($data['image']);
            $this->product->setCreationDate($data['creationDate']);
            $this->product->edit();
            $this->cart->setId($idCart);
            $dataCart = $this->cart->view();
            $this->itemsCart->setIdCart($idCart);
            if(is_null($dataCart)) // The shopping cart does not exist and a new one is created.
            {
                $this->cart->add();
            }
            $this->itemsCart->add();
            header("Location: ".URL."cart/toListUser/".$this->cart->getId()."/".$this->cart->getIdUser());
        }
        return $data;
    }

    /**
     * Preview of the cart.
     * @param $id   Integer integer.
     * @return array|null   Data of product.
     */
    public function preview(int $id)
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
    public function view(int $id=0):array
    {
        $this->cart->setId($id);
        $data = $this->cart->view();
        return $data;
    }

    /**
     * Show the form for the shipment of the products and request the type of
     * shipment.
     * @param int $id   Default 1.
     * @param int $idU  Default 1.
     * @return array|null   $data
     */
    public function shipping(int $id=1, int $idU=1)
    {
        $this->cart->setId($id);
        $this->cart->setIdUser($idU);  //Debug
        $data = $this->cart->toListUser();
        if (!is_null($data))
        {
            $this->itemsCart->setIdCart($id);
            $array = $this->itemsCart->totalList();
            $filed = $array->fetch_assoc();
            $this->subtotal = $filed['subtotal'];
        }
        if ($_POST)
        {
            $this->direction = $_POST['direction'];
            header("Location: ".URL."cart/toListUser/".$this->cart->getId()."/".$this->cart->getIdUser());
        }
        return $data;
    }

    /**
     * Accept the dispatch, show the shipping address and return to the list of products.
     * @param int $id   Default 0.
     */
    public function dispach(int $id=1, int $idU=1)
    {
        $this->cart->setId($id);
        $data = $this->itemsCart->setIdCart($id);
        return $data;
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
     * @return String
     */
    public function getDirection(): String
    {
        return $this->direction;
    }

    /**
     * @param String $direction
     */
    public function setDirection(String $direction): void
    {
        $this->direction = $direction;
    }

    /**
     * @param int $id Indice del registro.
     * @return array|null   Data of cart item.
     */
    public function edit(int $id=1)
    {
        $this->cart->setId($id);
        $data = $this->cart->view_Stock();
        $this->product->setId($data['idProduct']);
        if ($_POST)
        {
            $quantityPreview = $data['quantity'];
            $quantity = $_POST['quantity'];
            $this->cart->setQuantity($quantity);
            $this->product->setId($data['idProduct']);
            $product_data = $this->product->view();
            $totalPrice = $product_data["price"]*$quantity;
            $this->cart->setTotalPrice($totalPrice);
            $result = $product_data['stock'] - ($this->cart->getQuantity() - $quantityPreview);
            $this->product->setStock($result);
            $this->product->setId($product_data['id']);
            $this->product->setName($product_data['name']);
            $this->product->setPrice($product_data["price"]);
            $this->product->edit();
            $this->cart->edit();
            header("Location: ".URL."cart/toListUser/".$this->cart->getId()."/".$this->cart->getIdUser());
        }
        return $data;
    }

    /**
     * Delete a cart item.
     * @param int $id Integer with id to cart.
     * @param int $idU
     * @param int $idCart
     */
    public function remove(int $id=0, int $idU=1, int $idCart=1)
    {
        $this->cart->setId($idCart);
        $data = $this->cart->view();
        $this->product->setId($data['idProduct']);
        $product_data = $this->product->view();
        $result = $product_data['stock'] + $data['quantity'];
        $this->product->setStock($result);
        $this->product->setName($product_data['name']);
        $this->product->setPrice($product_data["price"]);
        $this->product->edit();
        $this->cart->delete();
        header("Location: ".URL."cart/toListUser/".$this->cart->getId()."/".$this->cart->getIdUser());
    }
    /**
     * @param int $idU
     * @param int $idCart
     */
    public function toListUser(int $idU=1, int $idCart=1)
    {
        echo 'Hola esta es la lista del usuario '.$idU.' para el carrito '.$idCart.'<br>';
    }
    /****/
    public function pay(int $idU=1, int $idCart=1)
    {
        echo 'Pagan el pedido.<br>';
    }

}
//
$cart = new cartController();
