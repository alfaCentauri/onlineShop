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

use Models\Users;
use Models\CartItems;
use Models\Cart as Cart;
use Models\Credit as Credit;
use Models\Product as Product;
use Models\Conection as Conection;
use Models\Qualification as Qualification;

/**
 * Description of cartController
 *
 * @package Controllers
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 1.2.
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
    private CartRepository $cartRepository;
    private UserRepository $userRepository;
    private CreditRepository $creditRepository;
    private ProductRepository $productRepository;
    private CartItemsRepository $cartItemsRepository;
    private QualificationRepository $qualificationRepository;
    
    /**
     * Construct
     **/
    function __construct() 
    {
        $this->conection = new Conection();
        $this->user = new Users();
        $this->userRepository = new UserRepository($this->user);
        $this->userRepository->setConection($this->conection);
        
        $this->cart = new Cart();
        $this->cartRepository = new CartRepository($this->cart);
        $this->cartRepository->setConection($this->conection);
        
        $this->product = new Product();
        $this->productRepository = new ProductRepository($this->product);
        $this->productRepository->setConection($this->conection);
        
        $this->itemsCart = new CartItems();
        $this->cartItemsRepository = new CartItemsRepository($this->itemsCart);
        $this->cartItemsRepository->setConection($this->conection);
        
        $this->qualification = new Qualification();
        $this->qualificationRepository = new QualificationRepository($this->qualification);
        $this->qualificationRepository->setConection($this->conection);
        
        $this->credit = new Credit();
        $this->creditRepository = new CreditRepository($this->credit);
        $this->creditRepository->setConection($this->conection);
        
        $this->subtotal = 0;
    }

    /**
     * Default.
     *
     * @param int $idU
     * @return bool|\mysqli_result  Data of list of the cart.
     */
    public function index(int $idU=1)
    {
        $this->cart->setIdUser($idU);        
        $dataCart = $this->cartRepository->viewNotPaidout();
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
            $data_users = $this->userRepository->view();
            return $data_users['firstName']." ".$data_users['lastName'];
        }
        return null;
    }
    
    /**
      * List all product carts.
      * @return null|array Return a array of data.
      */
    public function all()
    {
        $data = $this->cartRepository->all();
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
        $data = array();
        if ($id > 0)
        {
            $data = createArrayDataProduct($id);
            $this->cart->setIdUser($idU);
            $this->itemsCart->setIdProduct($this->product->getId());
            if ($_POST['quantity'] > 0)
            {
                updateItemOfCartShopping($_POST['quantity'], $this->product->getPrice());
                descountProductOfStock();
                appendQualification($_POST['points'], $idU);
                updateCartShopping($this->cartRepository->viewNotPaidout());                
                header("Location: ".URL."index.php?url=cart/toListUser/".$this->cart->getId()."/".$idU);
            }            
        }
        return $data;
    }
    
    /**
     * @param int $quantity Type Integer, quantity of item.
     * @param float $price Type float, price of item.
     */
    private function updateItemOfCartShopping(int $quantity = 0, float $price): void
    {
        $this->itemsCart->setQuantity($quantity);
        $this->itemsCart->setTotalPrice($price*$quantity);
    }

    /**
     * 
     */
    private function descountProductOfStock(): void
    {
        if($this->itemsCart->getQuantity() > 0)
        {
            $result = $this->product->getStock() - $this->itemsCart->getQuantity();            
            $this->product->setStock($result);
            $this->productRepository->edit();
        }
    }
    
    /**
     * @param int $points Integer with points.
     */
    private function appendQualification(int $points = 0, int $idU = 0): void
    {
        if ($points > 0) 
        {
            $this->qualification->setIdProduct($this->product->getId());
            $this->qualification->setPoints($points);
            $this->qualification->setIdUser($idU);
            $result = $this->qualificationRepository->findByUserProduct();
            if(is_null($result))
            {
                $this->qualification->add();
            }
        }
    }
    
    /**
     * @param array $dataCart Type array.
     */
    private function updateCartShopping($dataCart): void
    {
        if(is_null($dataCart))
        {
            $idCart=$this->cartRepository->add();
            if (isset($idCart))
            {
                $this->cart->setId($idCart);
                $this->itemsCart->setIdCart($idCart);
            }
        }
        else
        {
            $this->cart->setId($dataCart['id']);
            $this->cartRepository->edit();
            $this->itemsCart->setIdCart($dataCart['id']);
        }
        $this->itemsCart->add();
    }
    
    /**
     * Preview of the cart.
     * The route is: http://localhost/onlineShop/cart/preview/$id/$idU .
     * @param int $id   Integer index.
     * @param int $idU  Integer of index user.
     * @return array|null   Data of product.
     */
    public function preview(int $id=1, int $idU=0)
    {
        $dataProduct = createPreviewProduct($idU);            
        return $dataProduct;
    }
    
    /**
     * @return array|null   Data of product for preview.
     */
    private function createPreviewProduct(int $idProduct, int $idU): array
    {
        $data = createArrayDataProduct($idProduct);
        if (isset($this->product))
        {
            $this->qualification->setIdProduct($this->product->getId());
            $this->qualification->setIdUser($idU);
            $data['average'] = findAverageOfTheProduct();
            $data['points'] = findQualificationOfProductByUser();
        }
        return $data;
    }
    
    /**
     * @return array|null   Data of product for preview.
     */
    private function createArrayDataProduct($idProduct): array
    {
        $data = array();
        $this->product = $this->productRepository->find($idProduct);
        if (isset($this->product))
        {
            $data['id'] = $this->product->getId();
            $data['name'] = $this->product->getName();
            $data['price'] = $this->product->getPrice();
            $data['image'] = $this->product->getImage();
            $data['stock'] = $this->product->getStock();
            $data['creationDate'] = $this->product->getCreationDate();
        }
        return $data;
    }

    /**
     * @return float Return average of the product.
     */
    private function findAverageOfTheProduct(): float
    {
        $average = 0;
        $averageProduct = $this->qualificationRepository->findAverage();
        if (isset($averageProduct['average']))
            $average = number_format($averageProduct['average'], 2);
                
        return $average;
    }
    
    /**
     * Method for find the qualification of the product.
     *
     * @return float Return qualification.
     */
    private function findQualificationOfProductByUser(): float
    {
        $points = 0;
        $qualification = $this->qualificationRepository->findByUserProduct();
        if(isset($qualification['points']))
            $points = $qualification['points']; 
            
        return $points
    }
    
    /**
     * Show a cart.
     * @param $id   Integer integer.
     * @return array|null   $id.
     */
    public function view(int $id=0):array
    {
        $data = createArrayDataCart($id);
        return $data;
    }
    
    /**
     * @param int $id Index.
     * @return array|null Data.
     */
    private function createArrayDataCart(int $id = 0)
    {
        $data = array();
        $this->cart = $this->cartRepository->find($id);
        if(isset($this->cart))
        {
            $data['id'] = $this->cart->getId();
            $data['idUser'] = $this->cart->getIdUser();
            $data['totalPrice'] = $this->cart->getTotalPrice();
            $data['direction'] = $this->cart->getDirection();
            $data['paidOut'] = $this->cart->getPaidOut();
            $data['creationDate'] = $this->cart->getCreationDate();
        }
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
        $infoForShipping = createShoppingCart($this->cartRepository->findByUser());        
        if ($_POST && $this->subtotal > 0)
        {
            processShipment($_POST['direction']); 
            addCostShipping($_POST['shipping']);
            header("Location: ".URL."index.php?url=cart/dispach/".$this->cart->getId()."/".$this->cart->getIdUser());
        }
        return $infoForShipping;
    }
    
    /**
     * @param array|null $shoppingCart Information of the shopping cart for 
     * current user.
     *
     * @return array Return array of data shopping cart.
     */
    private function createShoppingCart($shoppingCart): array
    {
        $infoForShipping = array();
        if (isset($shoppingCart))
        {
            $infoForShipping['id'] = $shoppingCart['id'];
            $infoForShipping['idUser'] = $shoppingCart['idUser'];            
            findDataCredit($shoppingCart['idUser']);
            $infoForShipping['balanceCredit'] = $this->credit->getBalance();
            $this->itemsCart->setIdCart($shoppingCart['id']);
            $sumSubTotal = $this->cartItemsRepository->totalList();
            $this->subtotal = $sumSubTotal['subtotal'];
            $infoForShipping['subtotal'] = number_format(
                $sumSubTotal['subtotal'], 2);
            $infoForShipping['remainingBalance'] = number_format(
                $infoForShipping['balanceCredit'] - 
                $infoForShipping['subtotal'],
                    2);
        }
        return $infoForShipping;
    }
    
    /**
     * @param int $idUser Index.
     */
    private function findDataCredit(int $idUser = 0): void
    {
        $this->credit->setIdUser($idUser);
        $this->credit = $this->creditRepository->findByUser();
    }
    
    /**
     * @param String $direction String with direction.
     */
    private function processShipment($direction)
    {
        $this->cart->setDirection($direction);        
        $this->credit->setBalance($this->credit->getBalance() - $this->cart->getTotalPrice());
        $this->creditRepository->edit();
        $this->cart->setPaidOut(true);
        $this->cartRepository->edit();
    }
    
    /**
     * @param float $shipping Cost of shipping.
     */
    private function addCostShipping(float $shipping = 0)
    {
        if($shipping == 5)
        {
            $this->cart->setTotalPrice(($this->subtotal+5));
        }
        else
        {
            $this->cart->setTotalPrice($this->subtotal);
        }
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
        $dataCart = createArrayDataCart($id);
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
        $data = createArrayDataItemCart($id);
        return $data;
    }
    
    /***/
    private function createArrayDataItemCart($id)
    {
        $data = array();
        findItemCart($id);
        if(isset($this->itemsCart))
        {
            $data['id'] = $this->itemsCart->getId();
            $data['idProduct'] = $this->itemsCart->getIdProduct();
            $data['quantity'] = $this->itemsCart->getQuantity();
            $data['totalPrice'] = $this->itemsCart->getTotalPrice();
            $data['creationDate'] = $this->itemsCart->getCreationDate();
        }
        return $data;
    }
    
    /**
     * @param int $idItemCart Index to item cart.
     */
    private function findItemCart(int $idItemCart = 0): void
    {
        if($idItemCart > 0)
        {
            $this->itemsCart = $this->cartItemsRepository->find($id);
        }
    }
    
    /**
     * @param int $quantity Quantity of product.
     */
    private function appendQuantity(int $quantity): void
    {
        if($quantity > 0)
            $this->itemsCart->setQuantity($quantity);
    }

    /**
     * @param int $idProduct Index of product.
     */
    private function findProduct(int $idProduct = 0): void
    {
        if($idProduct > 0)
        {
            $this->product = $this->productRepository->find($idProduct); 
        }
    }
    
    /***/
    private function calcTotalPrice(): void
    {
        $totalPrice = $this->product->getPrice() * 
            $this->itemsCart->getQuantity();
        $this->itemsCart->setTotalPrice($totalPrice);
    }
    
    /**
     * @param int $quantityPreview Quantity preview of product in the cart 
     * shopping.
     */
    private function calcStock(int $quantityPreview): void
    {
        $result = $this->product->getStock() - 
            ($this->itemsCart->getQuantity() - $quantityPreview);
        $this->product->setStock($result);
    }
    
    /**
     * @param int $idCart Index of cart.
     */
    private function findCart(int $idCart = 0): void
    {
        if($idCart > 0)
        {
            $this->cart = $this->cartRepository->find($idCart);
        }
    }
    
    /**
     * Update total cart price.
     * @param float $pricePreview Price total preview of the cart.
     */
    private function updateTotalPriceCart(float $pricePreview): void
    {
        $updatePrice = $this->cart->getTotalPrice() -  ($pricePreview -
            $this->itemsCart->getTotalPrice());
        $this->cart->setTotalPrice($updatePrice);
        $this->cartRepository->edit();
    }
    
    /**
     * Method to update the product.
     * @param int $id Index.
     */
    public function update(/*int $id = 0*/)
    {
        if ($_POST)
        {
            $pricePreview = $this->itemsCart->getTotalPrice();
            appendQuantity($_POST['quantity']);
            findProduct($this->itemsCart->getIdProduct());
            calcTotalPrice();
            calcStock($this->itemsCart->getQuantity());
            $this->productRepository->edit();
            $this->cartItemsRepository->edit();
            findCart($this->itemsCart->getIdCart());
            updateTotalPriceCart($pricePreview);                        
        }
        header("Location: ".URL."index.php?url=cart/");
    }
    
    /**
     * Delete a cart item.
     * @param int $id Integer with id to cart item.
     */
    public function remove(int $id = 0)
    {
        findItemCart($id);
        findProduct($this->itemsCart->getIdProduct());
        returnProductToStock($this->itemsCart->getQuantity());
        findCart($this->itemsCart->getIdCart());
        updateTotalPriceCart(0);                
        $this->cartItemsRepository->delete();
        header("Location: ".URL."index.php?url=cart/");
    }

    /**
     * @param int $quantity Quantity to return.
     */
    private function returnProductToStock(int $quantity = 0):void 
    {
        if ($quantity > 0) 
        {
            $result = $this->product->getStock() + $quantity;
            $this->product->setStock($result);    
            $this->productRepository->edit();
        }
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
        $data = $this->cartRepository->toListItemsCart();
        return $data;
    }

}
//
$cart = new cartController();
