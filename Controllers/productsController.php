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
class productsController
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
        $data = $this->product->toList();
        return $data;
    }
    /**
     * Method to create the product.
     * @param $newProduct
     */
    public function add()
    {
        if ($_POST)
        {
            $permitted = array("image/jpeg", "image/png", "image/gif", "image/jpg");
            $limit = 700;
            if (in_array($_FILES['image']['type'], $permitted) && $_FILES['image']['size'] <= $limit*1024){
                $name = date('is').$_FILES['image']['name'];
                $ruta = "Views".DS."Templates".DS."images".DS."products".DS.$name;
//                print 'La ruta es '.$ruta.' <br>'; //Debug
                move_uploaded_file($_FILES['image']['tmp_name'], $ruta);
                $this->product->setName($_POST['name']);
                $this->product->setPrice($_POST['price']);
                $this->product->setStock($_POST['stock']);
                $this->product->setImage($name);
                $this->product->add();
                header("Location: ".URL."index.php?url=products");
//                print 'El nombre es: '.$this->product->getName().' <br>'; //Debug
            } else {
                print '<h4 class="error">El archivo no es valido.</h4>'; //Debug
            }
        }
    }

    /**
     * Show a product.
     * @param $id   Integer integer.
     */
    public function view($id)
    {
        $this->product->setId($id);
        $data = $this->product->view();
        return $data;
    }
    /**
     * Method to update the product.
     * @param $modifiedProduct  Product Product.
     */
    public function edit($id){
        $this->product->setId($id);
        if (!$_POST){
            $data = $this->product->view();
            return $data;
        } else {
            $this->product->setNombre($_POST['name']);
            $this->product->setEdad($_POST['price']);
            $this->product->setPromedio($_POST['stock']);
            $this->product->edit();
            header("Location: ".URL."index.php?url=products");
        }
    }

    /**Delete a product
     * @param $id   Integer integer.
     */
    public function delete($id)
    {

    }
}
//
$products = new productsController();