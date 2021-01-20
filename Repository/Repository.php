<?php
/**
 * Copyright (C) 2020 Ingeniero en Computación: Ricardo Presilla.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Repository;

use Models\Conection;

/**
 * Abstract class to define common methods to all, find, find by and order by and parameter conection.
 *
 * @package Repository.
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 1.2.
 */
abstract class Repository
{
    /**
     * Conetion to DB.
     * @var Conection
     */
    protected Conection $conection;
    
    /**
     * @return Conection
     */
    public function getConection(): Conection
    {
        return $this->conection;
    }
    
    /**
     * @param Conection $conection
     */
    public function setConection(Conection $conection): void
    {
        $this->conection = $conection;
    }
    
    /**
     * List of all registers.
     * 
     * @return null|array Result of the query.
     */
    abstract public function all();

    /**
     * Find a record for you id.
     * @param int $id Index.
     */
    abstract public function find(int $id);

    /**
     * Find a record for at value param.
     * @param String $param Param for find.
     * @param String $value Value.
     */
    abstract public function findBy(String $param, String $value);

    /**
     * Order all records by param.
     * @param string $param Param for order.
     * @param string $order Order asc or des.
     */
    abstract public function orderBy(string $param, string $order = "ASC");
    
    /**
     * Add a register
     */
    abstract public function add();
    
    /**
     * Edit record indicated by the current id.
     */
    abstract public function edit();
    
    /**
     * Display a record indicated by the current id.
     * @return array|null Return an arrangement with the record.
     */
    abstract public function view();
    
    /**
     * Delete record indicated by the current id.
     */
    abstract public function delete();
}
