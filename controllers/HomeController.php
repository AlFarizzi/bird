<?php
namespace app\controllers;
use app\controllers\Controller;
use app\core\Request;
use app\exception\ValidationException;

class HomeController extends Controller{
    // Controller RULE  
    // public function nameFunction($params = [])
    
    public function index($params = []) {
        $this->view("index", ["nama" => "fariz"]);
    }
    
    public function setting($params = []) {
    }

    public function posting($request) {
        try {
            Request::validate([
                "nama" => ["required", "max:5"],
                "alamat" => ["required"]
            ],$request);
        } catch (ValidationException $exception) {
            var_dump($exception->getMessage());            
        }
    }
}