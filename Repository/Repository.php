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

use phpDocumentor\Reflection\Types\Integer;

/**
 * Interface class to define common methods to find, find by and order by.
 *
 * @package Repository.
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 1.0.
 */
interface Repository
{
    /**
     * List of all registers.
     * 
     * @return null|array Result of the query.
     */
    public function all();
    /**
     * Find a record for you id.
     * @param Integer $id Index.
     */
    public function find(Integer $id);

    /**
     * Find a record for at value param.
     * @param String $param Param for find.
     * @param String $value Value.
     */
    public function findBy(String $param, String $value);

    /**
     * Order all records by param.
     * @param String $param Param for order.
     * @param String $order Order asc or des.
     */
    public function orderBy(String $param, String $order = 'ASC');
}
