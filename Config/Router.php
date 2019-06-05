<?php

/*
 * Licence GNU.
 */

namespace Config;

/**
 * Description of Router
 *
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 1.0.
 */
class Router {
    public static function Run(Request $request){
        $controller = $request->getController()."Controller";
        $route = ROOT."Controllers".DS. $controller.".php";
        $method = $request->getMethod();
        if ($method=="index.php"){
            $method = "index";
        }
        $argument = $request->getArgument();
        if (is_readable($route)){
            require_once $route; 
            $mostrar = "Controllers\\".$controller;
            $controller = new $mostrar;
            if (!isset($argument)) {
                $data = call_user_func(array($controller,$method));
            } else {
                $data = call_user_func_array(array($controller,$method), $argument);
            }
        } else {
            print '<strong class="error">Route error. The router can not find the file: '.$route."</strong><br>";
        }
        
        //Load views
        $route = ROOT."Views".DS.$request->getController().DS.$request->getMethod().".php";
        if (is_readable($route)){
            require_once $route; 
        } else {
            print '<strong class="error">Route error. The router can not find the file: '.$route."</strong><br>";
        }
    }
}
