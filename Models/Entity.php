<?php
/**
 * Created by PhpStorm.
 * User: rpres
 * Date: 6/7/2019
 * Time: 7:06 PM
 */

namespace Models;

/**
 * Abstract class to define common methods to create, read, update and delete.
 *
 * @package Models.
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 1.0.
 */
abstract class Entity
{
    /**
     * @var Conection
     */
    protected $conn;
    /**
     * It contains the index
     * @var integer
     */
    protected $id;
    /**
     * Contains creation date.
     */
    protected $creationDate;

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
    /**
     * Display a record indicated by the current id.
     * @return array|null Return the register if found else return null.
     */
    abstract public function view();
    /**
     * Add a register.
     */
    abstract public function add();
    /**
     * Edit record indicated by the current id.
     */
    abstract public function edit();
    /**
     * Delete record indicated by the current id.
     */
    abstract public function delete();
    /**
     * Get a list of all the records.
     * @return mixed
     */
    abstract public function toList();
}