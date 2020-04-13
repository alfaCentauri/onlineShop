<?php
/**
 * Created by PhpStorm.
 * User: Ricardo Presilla
 * Date: 6/1/2019
 * Time: 2:37 PM
 */

namespace Models;

/**
 * Entity for the products table.
 *
 * @package Models
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 2.0.
 */
class Product extends Entity
{
    /**
     * Contains the name.
     * @var String
     */
    private $name;
    /**
     * Contains the price.
     * @var float
     */
    private $price;
    /**
     * Contains the stock.
     * @var int
     */
    private $stock;
    /**
     * Contains name image.
     * @var String
     */
    private $image;
    
    /**
     * Product constructor.
     */
    function __construct()
    {
        $this->id=0;
        $this->name="";
        $this->price=0.0;
        $this->stock=0;
        $this->image="noImage.jpg";
    }
    
    /**
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param String $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return Integer
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param Integer $stock
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    }
        
    public function getImage() 
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }
    
}
