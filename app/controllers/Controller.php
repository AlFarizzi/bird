<?php
namespace app\controllers;

class Controller {
    public function view(string $view, array $data) {
        include 'resources/views/'.$view.'.php';
    }
}

?>