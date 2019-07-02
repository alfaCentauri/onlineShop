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
 * @version 1.0.
 */
class Product implements Crud
{
    /**
     * It contains the index.
     * @var int
     */
    private $id;
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
     * Contains creation date.
     *@var mixed
     */
    private $creationDate;
    /**
     * Conetion to DB.
     * @var Conection
     */
    private $conection;
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
     * @return mixed Creation date.
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
        return $this->conection;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function setCon($con)
    {
        $this->conection = $con;
    }

    /**
     * 
     * @param mixed $creationDate
     */
    public function setCreationDate($creationDate) 
    {
        $this->creationDate = $creationDate;
    }
    /**List**/
    public function toList()
    {
        $sql = "SELECT * FROM products;";
        $data = $this->conection->ReturnQuery($sql);
        return $data;
    }
    /**Add register*/
    public function add()
    {
        $sql = "INSERT INTO products(name, price, image, stock, creationDate) VALUES('{$this->name}', '{$this->price}', '{$this->image}', '{$this->stock}',NOW());";
        $this->conection->SimpleQuery($sql);
    }
    /**Delete record indicated by the current id.*/
    public function delete()
    {
        $sql = "delete from products where id='{$this->id}';";
        $this->conection->SimpleQuery($sql);
    }
    /**Edit record indicated by the current id.*/
    public function edit()
    {
        $sql = "update products set name='{$this->name}', price="
        . "'{$this->price}', stock='{$this->stock}' where id='{$this->id}';";
        $this->conection->SimpleQuery($sql);
    }
    /**Display a record indicated by the current id.*/
    public function view()
    {
        $sql = "SELECT * FROM products where id='{$this->id}'";
        $data = $this->conection->ReturnQuery($sql);
        $row = mysqli_fetch_assoc($data);
        return $row;
    }
    /**List witch average**/
    public function toListAverage()
    {
        $sql = "SELECT P.* FROM products P
              INNER JOIN qualification Q
              ON Q.idProduct=P.id;";
        $data = $this->conection->ReturnQuery($sql);
        return $data;
    }
}