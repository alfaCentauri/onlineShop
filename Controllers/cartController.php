<?php

/*
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

namespace Controllers;

use Models\Cart as Cart;
use Models\CartItems;
use Models\Product as Product;
use Models\Users;
use Models\Qualification as Qualification;
use Models\Credit as Credit;
use Models\Conection as Conection;

/**
 * Description of cartController
 *
 * @package Controllers
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
     * @var Product
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
     * Contains a object of type Qualification.
     * @var Qualification
     */
    private $qualification;
    /**
     * Contains a object of type Credit.
     * @var Credit
    */
    private $credit;
    /**
     * @var Conection
     */
    private $conection;
    /**
     * Construct
     **/
    function __construct() 
    {
        $this->conection = new Conection();
        $this->user = new Users();
        $this->user->setConection($this->conection);
        $this->cart = new Cart();
        $this->cart->setConn($this->conection);
        $this->product = new Product();
        $this->product->setCon($this->conection);
        $this->itemsCart = new CartItems();
        $this->itemsCart->setConn($this->conection);
        $this->qualification = new Qualification();
        $this->qualification->setConn($this->conection);
        $this->credit = new Credit();
        $this->credit->setConn($this->conection);
        $this->subtotal =0;
    }

    /**Default
     * @param int $idU
     * @return bool|\mysqli_result  Data of list of the cart.
     */
    public function index(int $idU=1)
    {
        $this->cart->setIdUser($idU);
        $dataCart = $this->cart->viewNotPaidout();
        if (isset($dataCart))
        {
            $this->cart->setId($dataCart['id']);
            $data = $this->cart->toListItemsCart();
            return $data;
        }
        else
        {
            return null;
        }
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
     * First check if the shopping cart exists; then add the items to the cart. 
     * If it does not exist, a new one is created.
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
        if ($id>0)
        {
            $this->product->setId($id);
            $data = $this->product->view();
            $this->cart->setIdUser($idU);
            $this->itemsCart->setIdProduct($data['id']);
            if ($_POST && $_POST['quantity']>0)
            {
                $quantity = $_POST['quantity'];
                $this->itemsCart->setQuantity($quantity);
                $this->itemsCart->setTotalPrice($data["price"]*$quantity);
                $result = $data['stock'] - $this->itemsCart->getQuantity();
                $this->product->setStock($result);
                $this->product->setId($data['id']);
                $this->product->setName($data['name']);
                $this->product->setPrice($data["price"]);
                $this->product->edit();
                if ($_POST['points']>0) //Points
                {
                    $points = $_POST['points'];
                    $this->qualification->setIdProduct($this->product->getId());
                    $this->qualification->setPoints($points);
                    $this->qualification->setIdUser($idU);
                    $result = $this->qualification->findByUserProduct();
                    if(is_null($result))
                    {
                        $this->qualification->add();
                    }
                }
                $this->cart->setId($idCart);
                $dataCart = $this->cart->viewNotPaidout();
                if(is_null($dataCart))
                {
                    $idCart=$this->cart->add();
                    if (isset($idCart))
                    {
                        $this->cart->setId($idCart);
                        $this->itemsCart->setIdCart($idCart);
                    }
                }
                elseif ($dataCart['paidOut']==1)
                    {
                        $idCart=$this->cart->add();
                        if (isset($idCart))
                        {
                            $this->cart->setId($idCart);
                            $this->itemsCart->setIdCart($idCart);
                        }
                    }
                    else
                    {
                        $this->cart->setId($dataCart['id']);
                        $this->cart->edit();
                        $this->itemsCart->setIdCart($dataCart['id']);
                    }
                $this->itemsCart->add();
                header("Location: ".URL."index.php?url=cart/toListUser/".$this->cart->getId()."/".$idU);
            }
            return $data;
        }
        else
        {
            return null;
        }
    }

    /**
     * Preview of the cart.
     * The route is: http://localhost/onlineShop/cart/preview/$id/$idU .
     * @param int $id   Integer integer.
     * @param int $idU  Integer of index user.
     * @return array|null   Data of product.
     */
    public function preview(int $id=1, int $idU=0)
    {
        $this->product->setId($id);
        $product = $this->product->view();
        if (isset($product['id']))
        {
            $data = array();
            $data['id'] = $product['id'];
            $data['name'] = $product['name'];
            $data['price'] = $product['price'];
            $data['image'] = $product['image'];
            $data['stock'] = $product['stock'];
            $data['creationDate'] = $product['creationDate'];
            $this->qualification->setIdProduct($product['id']);
            $averageProduct = $this->qualification->findAverage();
            if (isset($averageProduct['average']))
            {
                $data['average'] = number_format($averageProduct['average'], 2);
            }
            else
            {
                $data['average'] = 0;
            }
            $this->qualification->setIdUser($idU);
            $qualification = $this->qualification->findByUserProduct();
            if(is_null($qualification))
            {
                $data['points'] = 0;
            }
            else
            {
                $data['points'] = $qualification['points'];
            }
        }
        else
            $data = null;
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
     * @param int $id Default 1, index of cart.
     * @param int $idU Default 1, index of user.
     * @return array Array with shipping information.
     */
    public function shipping(int $id=1, int $idU=1)
    {
        $infoForShipping = array();
        $this->cart->setId($id);
        $this->cart->setIdUser($idU);
        $shoppingCart = $this->cart->findByUser();
        if (!is_null($shoppingCart))
        {
            $infoForShipping['id'] = $shoppingCart['id'];
            $infoForShipping['idUser'] = $shoppingCart['idUser'];
            $this->credit->setIdUser($shoppingCart['idUser']);
            $dataCredit = $this->credit->findByUser();
            $infoForShipping['balanceCredit'] = $dataCredit['balance'];
            $this->itemsCart->setIdCart($shoppingCart['id']);
            $array = $this->itemsCart->totalList();
            $this->subtotal = $array['subtotal'];
            $infoForShipping['subtotal'] = number_format($array['subtotal'],2);
            $infoForShipping['remainingBalance'] = number_format($infoForShipping['balanceCredit'] - $infoForShipping['subtotal'],2);
        }
        if ($_POST && $this->subtotal>0)
        {
            $this->cart->setDirection($_POST['direction']);
            if($_POST['shipping']==5)
            {
                $this->cart->setTotalPrice(($this->subtotal+5));
            }
            else
            {
                $this->cart->setTotalPrice($this->subtotal);
            }
            $dataCredit['balance'] = $infoForShipping['balanceCredit'] - $this->cart->getTotalPrice();
            $this->credit->setId($dataCredit['id']);
            $this->credit->setBalance($dataCredit['balance']);
            $this->credit->edit();
            $this->cart->setPaidOut(true);
            $this->cart->edit();
            header("Location: ".URL."index.php?url=cart/dispach/".$this->cart->getId()."/".$this->cart->getIdUser());
        }
        return $infoForShipping;
    }
    /**
     * Accept the dispatch, show the shipping address and return to the cart paid.
     * @param int $id Default 0.
     * @param int $idU
     * @return array|null   Returns the data of the cart paid with the total amount of the operation and the shipping
     * address.
     */
    public function dispach(int $id=1, int $idU=1)
    {
        $this->cart->setId($id);
        $this->cart->setIdUser($idU);
        $this->itemsCart->setIdCart($id);
        $dataCart = $this->cart->view();
        return $dataCart;
    }
    /**
     * Edit an item in the shopping cart.
     * The route for this method is: http://localhost/onlineShop/cart/edit/$id .
     * @param int $id Index of the item.
     * @return array|null   Data of cart item.
     */
    public function edit(int $id=1)
    {
        $this->itemsCart->setId($id);
        $data = $this->itemsCart->view();
        $this->product->setId($data['idProduct']);
        if ($_POST)
        {
            $quantityPreview = $data['quantity'];
            $quantity = $_POST['quantity'];
            $this->itemsCart->setQuantity($quantity);
            $this->product->setId($data['idProduct']);
            $product_data = $this->product->view();
            $totalPrice = $product_data["price"]*$quantity;
            $PricePreview = $data['totalPrice'];
            $this->itemsCart->setTotalPrice($totalPrice);
            $result = $product_data['stock'] - ($this->itemsCart->getQuantity() - $quantityPreview);
            $this->product->setStock($result);
            $this->product->setId($product_data['id']);
            $this->product->setName($product_data['name']);
            $this->product->setPrice($product_data["price"]);
            $this->product->edit();
            $this->itemsCart->edit();
            //Update total cart price
            $this->cart->setId($data['idCart']);
            $dataCart = $this->cart->view();
            $updatePrice = $dataCart['totalPrice'] - ($PricePreview - $totalPrice);
            $this->cart->setTotalPrice($updatePrice);
            $this->cart->edit();
            header("Location: ".URL."index.php?url=cart/");
        }
        return $data;
    }

    /**
     * Delete a cart item.
     * @param int $id Integer with id to cart item.
     */
    public function remove(int $id=0)
    {
        $this->itemsCart->setId($id);
        $data = $this->itemsCart->view();
        if (isset($data))
        {
            $this->product->setId($data['idProduct']);
            $product_data = $this->product->view();
            if (isset($product_data)) {
                $result = $product_data['stock'] + $data['quantity'];
                $this->product->setStock($result);
                $this->product->setName($product_data['name']);
                $this->product->setPrice($product_data["price"]);
                $this->product->edit();
            }
            $this->cart->setId($data['idCart']);
            $shoppingCart=$this->cart->view();
            if (!empty($data['totalPrice']) && !empty($shoppingCart['totalPrice']))
            {
                $this->cart->setTotalPrice($shoppingCart['totalPrice'] - $data['totalPrice']);
                $this->cart->setDirection($shoppingCart['direction']);
                $this->cart->setPaidOut(false);
                $this->cart->edit();
            }
            $this->itemsCart->delete();
        }
        header("Location: ".URL."index.php?url=cart/");
    }

    /**
     * List of carts per user indicated.
     * The route to list to the cart will be:
     * http://localhost/onlineShop/cart/tolistuser/$idCart/$idU .
     * @param int $idU
     * @param int $idCart
     * @return bool|\mysqli_result List of carts per user indicated.
     */
    public function toListUser( int $idCart=1, int $idU=1)
    {
        $this->cart->setId($idCart);
        $this->cart->setIdUser($idU);
        $data = $this->cart->toListItemsCart();
        return $data;
    }

}
//
$cart = new cartController();
