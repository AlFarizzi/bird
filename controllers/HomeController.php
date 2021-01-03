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
        $data = Request::where("siswa",["nama", "=", "Consectetur voluptat", "alamat", "=", "samsul"]);
        $this->view("index");
    }

    public function post($params = [] ) {
        try {
            Request::validate([
                "nama" => ["required"],
                "alamat" => ["min:2"]
            ],$params);
            Request::create($params,"siswa");
        } catch (ValidationException $exception) {
            $this->handler($exception->getMessage());            
        }
    }

}