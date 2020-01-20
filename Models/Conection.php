<?php
/**
 * Created by PhpStorm.
 * User: rpres
 * Date: 6/1/2019
 * Time: 2:19 PM
 */

namespace Models;

/**
 * Class of Conection.
 *
 * @package Models.
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 1.1.
 */
class Conection
{
    /** Contains the name of the server*/
    private $servername = "localhost";
    /** Contains the MySQL user*/
    private $username = "phptest";
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
        $this->conn = new \mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    /**
     * 
     * @param String $sql   Simple query sql.
     */
    public function SimpleQuery($sql)
    {
        $this->conn->query($sql);
    }

    /**
     * @param $sql
     * @return bool|\mysqli_result
     */
    public function ReturnQuery($sql)
    {
        $data = $this->conn->query($sql);
        return $data;
    }

    /**
     * @param $sql
     * @return mixed
     */
    public function InsertQuery($sql)
    {
        if ($this->conn->query($sql) === TRUE)
        {
            $last_id = $this->conn->insert_id;
            return $last_id;
        }
        else
        {
            echo "Error: ".$sql."<br>".$this->conn->error."<br>" ;
            return 0;
        }
    }
    /**
     * Close conection.
     */
    public function Close()
    {
        $this->conn->close();
    }

}