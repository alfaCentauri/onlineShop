<?php
/**
 * Created by PhpStorm.
 * User: rpres
 * Date: 6/7/2019
 * Time: 7:06 PM
 */

namespace Models;


class Entity
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
     * Contains creation date.
     */
    private $creationDate;

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
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param mixed $creationDate
     */
    public function setCreationDate($creationDate): void
    {
        $this->creationDate = $creationDate;
    }

}