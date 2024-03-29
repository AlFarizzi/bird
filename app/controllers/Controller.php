<?php
namespace  Fariz\bird\app\controllers;

use  Fariz\bird\app\core\Router;
use Dotenv\Dotenv;
use eftec\bladeone\BladeOne;

if(file_exists("../.env")) {
    $dotenv = Dotenv::createImmutable('../');
} else {
    $dotenv = Dotenv::createImmutable('../../');
}
$dotenv->load();
class Controller {
    private $views = "../views";
    private $cache = "../app/cache";
    public function view(string $view, $data = []) {
        $blade = new BladeOne($this->views,$this->cache,BladeOne::MODE_DEBUG);
        echo $blade->run($view, ["data" => $data]);
    }

    public function back(?string $url = null) {
        if(is_null($url)) {
            header("Location:".$_SERVER["HTTP_REFERER"]);
        } else {
            header("Location: $url");
        }
    }

}

?>