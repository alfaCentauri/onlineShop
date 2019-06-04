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

namespace Config;

/**
 * Description of Request class. Clase para gestionar el requisito del usuario.
 *
 * @author Ingeniero en Computación: Ricardo Presilla.
 */
class Request {
    /**Controler*/
    private $controller;
    /**add, update, ...*/
    private $method;
    /**Argument**/
    private $argument;
    /**Constructor of Request.*/
    function __construct() {
        if(isset($_GET['url'])){
            $ruta = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
            $ruta = explode("/", $ruta);
            $ruta = array_filter($ruta);
            if ($ruta[0] == "index.php"){
                $this->controlador = "estudiantes";
            } else {
                $this->controlador = strtolower(array_shift($ruta));
            }            
            $this->method = strtolower(array_shift($ruta));
            if (!$this->method){
                $this->method = "index";
            } 
            $this->argument = $ruta;
        } else {
            $this->controlador = "estudiantes";
            $this->method = "index";
        }
    }
    //Getters
    /**
     * Method to obtain the controller.
     * 
     * @return String String with the name of the controller.
     */
    function getControlador() {
        return $this->controlador;
    }
    /**
     *  Obtain the method.
     *  @return String String with the name of method.
     */
    function getMetodo() {
        return $this->method;
    }
    /**
     * Obtain the argument.
     * @return String String with the argument.
     */
    function getArgumento() {
        return $this->argument;
    }
    
}
