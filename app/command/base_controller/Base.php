<?php
namespace  Fariz\bird\app\controllers;
use  Fariz\bird\app\model\User;
use \Dsheiko\Validate;
use  Fariz\bird\app\controllers\Controller;

class HomeController extends Controller{
    // Controller RULE  
    // public function nameFunction($params = [])
    
    public function index($params = []) {
        //get data 
        $data = User::get();
        // pass data to user
        $this->view("index", $data);
    }

    public function post($params = []) {
        // validation
        try {
           Validate::map($params, [
               "name" => ["mandatory", "notEmpty"],
               "email" => ["mandatory", "notEmpty", "IsEmailAddress"]
           ]);
           // create
           User::create([
               "name" => $params["name"],
               "email" => $params["email"],
               "password" => password_hash($params["password"], PASSWORD_DEFAULT)
           ]);
           $this->back();
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
   
}