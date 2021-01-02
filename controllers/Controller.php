<?php
namespace app\controllers;

use app\core\Router;

class Controller {
    public function view(string $view, $data = []) {
        $errors = $this->getErrors();
        include '../views/'.$view.'.php';
    }
    public function handler($message) {
        setcookie("Errors", $message, time() + 1);
        header("Location:".$_SERVER["HTTP_REFERER"]);
    }
    public function getErrors() {
        return $_COOKIE["Errors"];
    }
}

?>