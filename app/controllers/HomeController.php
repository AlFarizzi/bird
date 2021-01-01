<?php
namespace app\controllers;
use app\controllers\Controller;
class HomeController extends Controller{
    // Controller RULE  
    // public function nameFunction($params = [])
    
    public function index($params = []) {
        $this->view("index", ["nama" => "fariz"]);
    }
    
    public function setting($params = []) {
    }

    public function posting($request) {
        var_dump($request->nama);
    }
}