<?php
/**
 * Created by PhpStorm.
 * User: Ricardo Presilla
 * Date: 6/7/2019
 * Time: 7:06 PM
 */

namespace Models;

use phpDocumentor\Reflection\Types\Boolean;

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
     * @var int
     */
    protected int $id;
    /**
     * Contains creation date.
     */
    protected $creationDate;
    /**
     * @var bool
     */
    protected Boolean $active;

    /**
     * Entity constructor.
     */
    public function __construct()
    {
        $this->id = 0;
        $this->creationDate = "";
        $this->active = true;
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
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }
}
