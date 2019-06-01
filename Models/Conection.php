<?php
/**
 * Created by PhpStorm.
 * User: rpres
 * Date: 6/1/2019
 * Time: 2:19 PM
 */

namespace Models;


class Conection
{
    /** Contains the name of the server*/
    private $servername = "localhost";
    /** Contains the MySQL user*/
    private $username = "userShop";
    /** Contains the password */
    private $password = "userShop.19";
    /** Contains the name of the database*/
    private $dbname = "shop";
    /** Contains the conection */
    private $conn;
    /**
     * Conection constructor.
     */
    public function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        echo 'Connection OK';
    }
    /**
     * Close conection.
     */
    public function Close()
    {
        $this->conn->close();
    }

}