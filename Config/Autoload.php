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
 * @version 1.0.
 */
class Autoload {
    public static function Run(){
        spl_autoload_register(function($class){
            $url = str_replace("\\", "/", $class).".php";
            if(is_readable($url)){
                require_once $url;
            }else {
                print 'The file does not exists. <h4>'.$url.'</h4>';
            }
        });
    }
}
