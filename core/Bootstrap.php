<?php
namespace app\core;
use app\controllers\Controller;
use Illuminate\Database\Capsule\Manager as Capsule;

class Boot extends Controller{
   public function connection() {
      $capsule = new Capsule;
      $capsule->addConnection([
         "driver" => $_ENV["DRIVER"],
         "host" => $_ENV["HOST"],
         "database" => $_ENV["DBNAME"],
         "username" =>  $_ENV["USERNAME"],
         "password" => $_ENV["PASSWORD"]
      ]);
      $capsule->setAsGlobal();
      $capsule->bootEloquent();
   }
}
$boot = new Boot();
$boot->connection();