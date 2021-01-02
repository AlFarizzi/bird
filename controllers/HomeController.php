<?php
namespace app\controllers;
use app\controllers\Controller;
use app\core\Request;
use app\exception\ValidationException;
use app\core\Connection;
use app\core\Router;

class HomeController extends Controller{
    // Controller RULE  
    // public function nameFunction($params = [])
    
    public function index($params = []) {
        $this->view("index");
    }

    public function post($params = [] ) {
        try {
            Request::validate([
                "nama" => ["required"],
            ],$params);
            Request::create($params,"Sma");
        } catch (ValidationException $exception) {
            $this->handler($exception->getMessage());            
        }
    }

}