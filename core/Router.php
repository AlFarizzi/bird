<?php
namespace core;
class Router {
    static array $routes = [
        "get" => [],
        "post" => [],
    ];
    
    static function get($endpoint, $task) {
        array_push(
            self::$routes["get"] ,["endpoint" => $endpoint, "task" => $task]
        );
    }

    static function post($endpoint, $task) {
        array_push(
            self::$routes["post"] ,["endpoint" => $endpoint, "task" => $task]
        );
    }

    static function exec() {
        $method = self::getMethod();
        $endpoint = self::getEndPoint();
        $routes = self::$routes[$method];
        for ($i=0; $i < count($routes); $i++) { 
            if($routes[$i]["endpoint"] === $endpoint) {
                $filename = $routes[$i]['task'][0];
                $method = $routes[$i]['task'][1];
                if(class_exists($filename)) {
                    $obj = new $filename;
                    if(count($_POST) == 0) {
                        $params = $_GET;
                        call_user_func_array([$obj,$method],array($params));
                    } else {
                        $object = (object) $_POST;
                        call_user_func_array([$obj,$method],[$object]);
                    }
                }
            }
        }
    }

    static function getMethod() {  
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    static function getEndPoint() {
        if(count($_GET) === 0) {
            return $_SERVER['REQUEST_URI'];
        } else {
            // var_dump($_GET);
            return $_SERVER['PATH_INFO'];
        }
    }
}