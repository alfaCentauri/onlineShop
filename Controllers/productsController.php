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
use Models\Qualification as Qualification;
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
    /**
     * Contains a object of type Qualificationes.
     * @var Qualification
     */
    private $qualification;
    /**
     * productsController constructor.
     */
    function __construct()
    {
        $this->product = new Product();
        $this->qualification = new Qualification();
    }
    /**Default*/
    public function index()
    {
        $listProduct = $this->product->toList();
        foreach ($listProduct as $node)
        {
            $item = array();
            $item['id']=$node['id'];
            $item['name']=$node['name'];
            $item['price']=$node['price'];
            $item['image']=$node['image'];
            $item['stock']=$node['stock'];
            $item['creationDate']=$node['creationDate'];
            $this->qualification->setIdProduct($node['id']);
            $averageProduct = $this->qualification->findAverage();
            if (isset($averageProduct['average']))
            {
                $item['average']= number_format($averageProduct['average'],2);
            }
            else
            {
                $item['average']= 0;
            }
            $data[]=$item;
        }
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
                print '<h2 class="error text-center">Error: The file is not valid.</h2>';
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
            if (isset($averageProduct['average'])) {
                $data['average'] = number_format($averageProduct['average'], 2);
            } else {
                $data['average'] = 0;
            }
        }
        else
            $data = null;
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