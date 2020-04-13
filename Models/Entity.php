<?php
/**
 * Created by PhpStorm.
 * User: Ricardo Presilla
 * Date: 6/7/2019
 * Time: 7:06 PM
 */

namespace Models;

/**
 * Abstract class to define common methods to all the Models.
 *
 * @package Models.
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 1.0.
 */
abstract class Entity
{
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
     * @var Boolean
     */
    protected $active;

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
