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
    
}