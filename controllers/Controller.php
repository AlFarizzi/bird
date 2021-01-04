<?php
namespace app\controllers;

use app\core\Router;
use Dotenv\Dotenv;
use eftec\bladeone\BladeOne;
$dotenv = Dotenv::createImmutable('../');

if(file_exists("../.env")) {
    $dotenv = Dotenv::createImmutable('../');
} else {
    $dotenv = Dotenv::createImmutable('../../');
}
$dotenv->load();
class Controller {
    private $views = "../views";
    private $cache = "../cache";
    public function view(string $view, $data = []) {
        $blade = new BladeOne($this->views,$this->cache,BladeOne::MODE_DEBUG);
        echo $blade->run($view, $data);
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