<?php
/**
 * Created by PhpStorm.
 * User: rpres
 * Date: 6/7/2019
 * Time: 7:08 PM
 */

namespace Models;


class CartItems implements Crud
{
    /**
     * @var Conection
     */
    private $conn;
    /**
     * It contains the index
     * @var integer
     */
    private $id;
    /**
     * Contains the index of the cart.
     * @var int
    */
    private $idCart;
    /**
     * @var integer
     */
    private $idProduct;
    /**
     * Constains the quantity.
     * @var integer
     */
    private $quantity;
    /**
     * Constains the total price.
     * @var float
     */
    private $totalPrice;

    /**
     * CartItems constructor.
     */
    public function __construct()
    {
        $this->conn = new Conection();
        $this->id = 0;
        $this->idCart = 0;
        $this->idProduct = 0;
        $this->quantity = 0;
        $this->totalPrice = 0;
    }

    /**
     * @return Conection
     */
    public function getConn(): Conection
    {
        return $this->conn;
    }

    /**
     * @param Conection $conn
     */
    public function setConn(Conection $conn): void
    {
        $this->conn = $conn;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getIdCart(): int
    {
        return $this->idCart;
    }

    /**
     * @param int $idCart
     */
    public function setIdCart(int $idCart): void
    {
        $this->idCart = $idCart;
    }

    /**
     * @return int
     */
    public function getIdProduct(): int
    {
        return $this->idProduct;
    }

    /**
     * @param int $idProduct
     */
    public function setIdProduct(int $idProduct): void
    {
        $this->idProduct = $idProduct;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    /**
     * @param float $totalPrice
     */
    public function setTotalPrice(float $totalPrice): void
    {
        $this->totalPrice = $totalPrice;
    }
    /**
     * View register.
     * @return array|null Return an arrangement with the record.
     */
    public function view()
    {
        $sql = "SELECT I.*, P.name as name_product, P.image as image_product, P.stock as stock 
          FROM itemsCart I 
          INNER JOIN products P 
          on I.idProduct=P.id and I.id='{$this->id}';";
        $data = $this->conn->ReturnQuery($sql);
        $row = mysqli_fetch_assoc($data);
        return $row;
    }
    /**
     * Add register
     */
    public function add()
    {
        $sql = "INSERT INTO itemsCart(id, idCart, idProduct, quantity, totalPrice) VALUES(NULL, '{$this->idCart}', '{$this->idProduct}', '{$this->quantity}', '{$this->totalPrice}');";
        $this->conn->SimpleQuery($sql);
    }
    /**
     * Edit record indicated by the current id.
     */
    public function edit()
    {
        $sql = "update itemsCart set quantity='{$this->quantity}', totalPrice='{$this->totalPrice}' where id='{$this->id}';";
        $this->conn->SimpleQuery($sql);
    }
    /**
     * Delete record indicated by the current id.
     */
    public function delete()
    {
        $sql = "delete from itemsCart where id='{$this->id}';";
        $this->conn->SimpleQuery($sql);
    }
    /**
     * Get a list of all the records.
     */
    public function toList()
    {
        $sql = "SELECT * FROM itemsCart;";
        $data = $this->conn->ReturnQuery($sql);
        return $data;
    }
    /**
     * Get a list of all records with the image and the name of the associated
     * product.
     */
    public function toList2()
    {
        $sql = "SELECT T1.*, T2.name as name_product, T2.image as image_product FROM itemsCart T1 INNER JOIN products T2 on T1.idProduct=T2.id ;";
        $data = $this->conn->ReturnQuery($sql);
        return $data;
    }
    /**
     * Get a list of all the records for a cart.
     */
    public function totalList()
    {
        $sql = "SELECT sum(T1.totalPrice) as subtotal FROM itemsCart T1 where T1.idCart='{$this->idCart}';";
        $data = $this->conn->ReturnQuery($sql);
        $row = mysqli_fetch_assoc($data);
        return $row;
    }
}