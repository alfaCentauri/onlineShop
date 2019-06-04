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

    /**
     * Method to create the product.
     * @param $newProduct
     */
    public function create($newProduct)
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
    public function read($id)
    {

    }
    /**
     * Method to update the product.
     * @param $modifiedProduct  Type Product.
     */
    public function update($modifiedProduct)
    {

    }

    /**Delete a product
     * @param $id   Type integer.
     */
    public function delete($id)
    {

    }
}