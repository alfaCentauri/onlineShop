<?php

/*
 * Licence GNU.
 */

namespace Config;

/**
 * Description of Router
 *
 * @author Ingeniero en Computación: Ricardo Presilla.
 */
class Router {
    public static function Run(Request $request){
        $controller = $request->getController()."Controller";
        //print 'El controlador en router es: '.$controller."<br>"; //Debug
        $route = ROOT."Controllers".DS. $controller.".php";
        print 'La ruta en router es: '.$route."<br>"; //Debug
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
            print 'La ruta del controlador es: '.$route."<br>"; //Debug
        } else {
            print '<strong class="error">Route error. The router can not find the file: '.$route."</strong><br>";
        }
        
        //Load views
        $route = ROOT."Views".DS.$request->getController().DS.$request->getMethod().".php";
        print 'La ruta de la vista es: '.$route."<br>"; //Debug
        if (is_readable($route)){
            require_once $route; 
        } else {
            print '<strong class="error">Route error. The router can not find the file: '.$route."</strong><br>";
        }
    }
}
