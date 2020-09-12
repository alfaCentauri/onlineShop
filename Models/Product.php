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
     * @var string
     */
    private string $name;
    /**
     * Contains the price.
     * @var float
     */
    private float $price;
    /**
     * Contains the stock.
     * @var int
     */
    private int $stock;
    /**
     * Contains name image.
     * @var string
     */
    private string $image;
    
    /**
     * Product constructor.
     */
    function __construct()
    {
        $this->id = 0;
        $this->creationDate = "";
        $this->active = true;
        $this->name = "";
        $this->price = 0.0;
        $this->stock = 0;
        $this->image = "noImage.jpg";
    }
    
    /**
     * @return string Return a name.
     */
    public function getName():string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return float Return the price of product.
     */
    public function getPrice():float
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
     * @return int Return the stock of the product.
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param int $stock
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
