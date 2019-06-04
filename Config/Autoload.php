<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Config;

/**
 * Description of Autoload
 *
 * @author Ingeniero en Computación: Ricardo Presilla.
 */
class Autoload {
    public static function Run(){
        spl_autoload_register(function($class){
            $ruta = str_replace("\\", "/", $class).".php";
            if(is_readable($ruta)){
                require_once $ruta;
            }else {
                print 'The file does not exists. ';
            }
        });
    }
}
