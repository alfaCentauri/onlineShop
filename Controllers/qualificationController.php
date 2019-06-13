<?php
/*
 * Copyright (C) 2019 Ingeniero en Computación: Ricardo Presilla.
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

namespace Controllers;

use Models\Product as Product;
use Models\Users as Users;
use Models\Qualification as Qualificationes;
class qualificationController implements Crud
{
    /**
     * Contains a object of type Users.
     * @var Users
     **/
    private $user;
    /**
     * Contains a object of type Product.
     * @var Product
     */
    private $product;
    /**
     * Contains a object of type Qualificationes.
     * @var Qualificationes
     */
    private $qualification;
    /**
     * Qualification constructor.
     */
    public function __construct()
    {
        $this->user = new Users();
        $this->product = new Product();
        $this->qualification = new Qualificationes();
    }

    public function index()
    {
        $data = $this->qualification->listAverage();
        return $data;
    }

    public function add()
    {
        // TODO: Implement add() method.
    }

    public function view(int $id = 0)
    {
        // TODO: Implement view() method.
    }

    public function edit(int $id = 0)
    {
        // TODO: Implement edit() method.
    }

    public function remove(int $id = 0)
    {
        // TODO: Implement remove() method.
    }
}