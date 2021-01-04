<?php
namespace app\controllers;
use app\model\User;
use \Dsheiko\Validate;
use app\controllers\Controller;
class HomeController extends Controller{
    // Controller RULE  
    // public function nameFunction($params = [])
    
    public function index($params = []) {
        $this->view("index");
    }

    public function post($params = [] ) {
        try {
            $a = User::create([
                "name" => $params->name,
                "email" => $params->email,
                "password" => $params->password,
            ]);
        } catch (\Throwable $th) {
            $this->handler($th->getMessage());
        }
    }

}