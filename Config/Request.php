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
 * @version 1.0.
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
            $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
            $url = explode("/", $url);
            $url = array_filter($url);
            if ($url[0] == "index.php"){
                $this->controller = "products";
            } else {
                $this->controller = strtolower(array_shift($url));
            }            
            $this->method = strtolower(array_shift($url));
            if (!$this->method){
                $this->method = "index";
            } 
            $this->argument = $url;
        } else {
            $this->controller = "products";
            $this->method = "index";
        }
    }
    //Getters
    /**
     * Method to obtain the controller.
     * 
     * @return String String with the name of the controller.
     */
    function getController() {
        return $this->controller;
    }
    /**
     *  Obtain the method.
     *  @return String String with the name of method.
     */
    function getMethod() {
        return $this->method;
    }
    /**
     * Obtain the argument.
     * @return String String with the argument.
     */
    function getArgument() {
        return $this->argument;
    }
    
}
