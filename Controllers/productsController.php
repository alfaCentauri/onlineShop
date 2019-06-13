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

use Models\Product as Product;
/**
 * Controller of actions on products.
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 1.0.
 */
class productsController implements Crud
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
                move_uploaded_file($_FILES['image']['tmp_name'], $ruta);
                $this->product->setName($_POST['name']);
                $this->product->setPrice($_POST['price']);
                $this->product->setStock($_POST['stock']);
                $this->product->setImage($name);
                $this->product->add();
                header("Location: ".URL."index.php?url=products");
            } else {
                print '<h4 class="error">El archivo no es valido.</h4>'; //Debug
            }
        }
    }

    /**
     * Show a product.
     * @param $id   Integer integer.
     * @return array|null $data
     */
    public function view(int $id=0)
    {
        $this->product->setId($id);
        $data = $this->product->view();
        return $data;
    }

    /**
     * Method to update the product.
     * @param $id   Integer integer.
     * @return array|null Data
     */
    public function edit(int $id=0){
        $this->product->setId($id);
        if (!$_POST){
            $data = $this->product->view();
            return $data;
        } else {
            $this->product->setName($_POST['name']);
            $this->product->setPrice($_POST['price']);
            $this->product->setStock($_POST['stock']);
            $this->product->edit();
            header("Location: ".URL."index.php?url=products");
        }
        return null;
    }

    /**Delete a product
     * @param $id   Integer integer.
     */
    public function remove(int $id=0)
    {
        $this->product->setId($id);
        $this->product->delete();
        header("Location: ".URL."index.php?url=products");
    }
}
//
$products = new productsController();