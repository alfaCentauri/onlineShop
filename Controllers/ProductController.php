<?php
/**
 * Created by PhpStorm.
 * User: rpres
 * Date: 6/1/2019
 * Time: 2:46 PM
 */

namespace Controllers;

use Models\Product as Product;
/**
 * Controller of actions on products.
 */
class ProductController
{
    /**
     * Contains a object of type Product.
     */
    private $product;

    function __construct() 
    {
        $this->product = new Product();
    }
    /**Default*/
    public function index()
    {
        $data = $this->product->list();
        return $data;
    }
    /**
     * Method to create the product.
     * @param $newProduct
     */
    public function add($newProduct)
    {
        $this->product = new Product();
        $this->product->setName('apple');
        $this->product->setPrice(0.3);
        $this->product->setStock(100);
        $this->product = $newProduct;
    }

    /**
     * Show a product.
     * @param $id   Type integer.
     */
    public function view($id)
    {

    }
    /**
     * Method to update the product.
     * @param $modifiedProduct  Type Product.
     */
    public function edit($modifiedProduct)
    {

    }

    /**Delete a product
     * @param $id   Type integer.
     */
    public function delete($id)
    {

    }
}