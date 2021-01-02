<?php
namespace app\controllers;

class Controller {
    public function view(string $view, array $data) {
 
        include '../views/'.$view.'.php';
    }
}

?>