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
/**
 * Interface class to define common methods to create, read, update and delete.
 *
 * @package Controllers.
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 1.0.
 */
interface Crud
{
    public function index();
    public function add();
    public function view(int $id=0);
    public function edit(int $id=0);
    public function remove(int $id=0);
}