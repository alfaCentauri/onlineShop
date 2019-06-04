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
    define("DS", DIRECTORY_SEPARATOR);
    define("ROOT", realpath(dirname(__FILE__)).DS);
    define("URL", "http://localhost/onlineShop/");
    
    require_once 'Config/Autoload.php';
    
    Config\Autoload::Run();
    require_once 'Views/Templates.php';
//    $request = new Config\Request();
    Config\Router::Run(new Config\Request());
?>