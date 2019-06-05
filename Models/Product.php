<?php
/**
 * Created by PhpStorm.
 * User: rpres
 * Date: 6/1/2019
 * Time: 2:37 PM
 */

namespace Models;

/**
 * Entity for the products table
 *
 */
class Product
{
    /**It contains the index*/
    private $id;
    /**Contains the name*/
    private $name;
    /**Contains the price*/
    private $price;
    /** Contains the stock*/
    private $stock;
    /**Contains name image*/
    private $image;
    /**Contains creation date */
    private $creationDate;
    /**Conetion to DB.*/
    private $con;
    function __construct() 
    {
        $this->con=new Conection();
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    /**
     * 
     * @return Date Creation date.
     */
    public function getCreationDate() 
    {
        return $this->creationDate;
    }
    public function getImage() 
    {
        return $this->image;
    }

    public function getCon() 
    {
        return $this->con;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function setCon($con) {
        $this->con = $con;
    }

    /**
     * 
     * @param Date $creationDate
     */
    public function setCreationDate($creationDate) 
    {
        $this->creationDate = $creationDate;
    }
    /**List**/
    public function toList()
    {
        $sql = "SELECT * FROM products;";
        $data = $this->con->ReturnQuery($sql);
        return $data;
    }
    /**Add register*/
    public function add(){
        $sql = "INSERT INTO products(name, price, image, stock, creationDate) VALUES('{$this->name}', '{$this->price}', '{$this->image}', '{$this->stock}',NOW());";
        $this->con->SimpleQuery($sql);
    }
    /**Delete record indicated by the current id.*/
    public function delete(){
        $sql = "delete from products where id='{$this->id}';";
        $this->con->SimpleQuery($sql);
    }
    /**Edit record indicated by the current id.*/
    public function edit(){
        $sql = "update products set name='{$this->name}', price="
        . "'{$this->price}', stock='{$this->stock}' where id='{$this->id}';";
        $this->con->SimpleQuery($sql);
    }
    /**Display a record indicated by the current id.*/
    public function view(){
        $sql = "SELECT * FROM products where id='{$this->id}'";
        $datos = $this->con->ReturnQuery($sql);
        $row = mysqli_fetch_assoc($datos);
        return $row;
    }
}