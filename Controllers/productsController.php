<?php
/**
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

use Models\Users as Users;
use Models\Product as Product;
use Models\Conection as Conection;
use Models\Qualification as Qualification;
use Repository\UsersRepository as UserRepository;
use Repository\ProductRepository as ProductRepository;
use Repository\QualificationRepository as QualificationRepository;
/**
 * Controller of actions on products.
 *
 * @package Controllers.
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 1.1.
 */
class productsController implements Crud
{
    /**
     * Contains a object of type Users.
     * @var Users
     **/
    private $user;
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
     * @var Conection
     */
    private $conection;
    private UserRepository $userRepository;
    private ProductRepository $productRepository;
    private QualificationRepository $qualificationRepository;
    /**
     * productsController constructor.
     */
    function __construct()
    {
        $this->conection = new Conection();
        $this->user = new Users();
        $this->userRepository = new UserRepository($this->user);
        $this->userRepository->setConection($this->conection);
        
        $this->product = new Product();
        $this->productRepository = new ProductRepository($this->product);
        $this->productRepository->setConection($this->conection);
        
        $this->qualification = new Qualification();
        $this->qualificationRepository = new QualificationRepository($this->qualification);
        $this->qualificationRepository->setConection($this->conection);
    }
    
    /**Default*/
    public function index()
    {
        $data = array();
        $listProduct = $this->productRepository->all();
        foreach ($listProduct as $node)
        {
            $item = array();
            $item['id'] = $node['id'];
            $item['name'] = $node['name'];
            $item['price'] = $node['price'];
            $item['image'] = $node['image'];
            $item['stock'] = $node['stock'];
            $item['creationDate'] = $node['creationDate'];
            $averageProduct = $this->findAverageOfProduct(intval($node['id']));
            $item['average'] = number_format($averageProduct, 2);
            $data[] = $item;
        }
        return $data;
    }
    
    /**
     * Method to find the average of the product.
     * @param int $id Index of product.
     * @return float Return a float.
     */
    private function findAverageOfProduct(int $id = 0): float
    {
        $this->qualification->setIdProduct($id);
        $averageProduct = $this->qualificationRepository->findAverage();
        $result = 0;
        if (isset($averageProduct['average'])) {
            $result = $averageProduct['average'];
        }
        return $result;
    }
    
    /**
     * Method to create the product.
     */
    public function add()
    {
        if ($_POST && isset($_FILES['image']))
        {   
            $file = $_FILES['image'];
            if ($this->isValidImageFile($file))
            {
                $nameFile = $this->createNameFileOnServerAndSource($file);
                $this->appendProduct($_POST['name'], $_POST['price'], $_POST['stock'], $nameFile);
                header("Location: ".URL."index.php?url=products");
            } 
            else 
            {
                print '<h2 class="error text-center">Error: The file is not valid.</h2>';
            }
        }
    }
    
    /**
     * @param array $file Array of data file.
     * @return bool Return true or false.
     */
    private function isValidImageFile($file = null): bool
    {
        $permitted = array("image/jpeg", "image/png", "image/gif", "image/jpg");
        $limit = 700;
        if (in_array($file['type'], $permitted) && $file['size'] <= $limit*1024)
            return true;
        else
            return false;
    }

    /**
     * @param array $file Array of data file.
     * @return String Return name file.
     */
    private function createNameFileOnServerAndSource($file = null): String
    {
        $name = date('is').$file['name'];
        $ruta = "Views".DS."Templates".DS."images".DS."products".DS.$name;
        move_uploaded_file($file['tmp_name'], $ruta);
        return $name;
    }
    
    /**
     * @param String $productName Name of product.
     * @param String $productPrice Price of product.
     * @param String $productStock Stock of product.
     * @param String $nameFile Name file.
     */
    private function appendProduct(String $productName, String $productPrice, String $productStock, String $nameFile): void
    {
        $this->product->setName($productName);
        $this->product->setPrice(floatval($productPrice));
        $this->product->setStock((int) $productStock);
        $this->product->setImage($nameFile);
        $this->productRepository->add();
    }
    
    /**
     * Show a product.
     * @param int $id Index.
     * @return array|null $data
     */
    public function view(int $id = 0):array
    {
        $data = $this->createArrayDataProduct($id);
        return $data;
    }
    
    /**
     * @param int $id Index.
     * @return array|null Data.
     */
    private function createArrayDataProduct(int $id = 0):array
    {
        $data = array();
        $this->product = $this->productRepository->find($id);
        if (isset($this->product))
        {
            $data['id'] = $this->product->getId();
            $data['name'] = $this->product->getName();
            $data['price'] = $this->product->getPrice();
            $data['image'] = $this->product->getImage();
            $data['stock'] = $this->product->getStock();
            $data['creationDate'] = $this->product->getCreationDate();
            $this->findAverageOfProduct($this->product->getId());
            $data['average'] = $this->getAverageOfProduct();
        }    
        return $data; 
    }
    
    /**
     * @return float Return average of product.
     */
    private function getAverageOfProduct(): float
    {
        $dataAverage = $this->qualificationRepository->findAverage();
        $average = 0;
        if(isset($dataAverage))
            $average = number_format($dataAverage, 2);

        return $average;
    }
    
    /**
     * Method to show form for edit the product.
     * @param $id   Integer integer.
     * @return array|null Data
     */
    public function edit(int $id = 0): array
    {
        $data = $this->createArrayDataProduct($id);
        return $data;        
    }

    /**
     * Method to update the product.
     */
    public function update()
    {
        if ($_POST)
        {
            $this->product->setName($_POST['name']);
            $this->product->setPrice($_POST['price']);
            $this->product->setStock($_POST['stock']);
            $this->productRepository->edit();            
        }
        header("Location: ".URL."index.php?url=products");
    }
    
    /**
     * Delete a product
     * @param $id   Integer integer.
     */
    public function remove(int $id=0)
    {
        $this->product->setId($id);
        $this->productRepository->delete();
        header("Location: ".URL."index.php?url=products");
    }
}
//
$products = new productsController();
