<?php
namespace app\core;
use app\controllers\Controller;
use PDO;

class Connection extends Controller{
    public function connection() {
        $dbname = $_ENV["DBNAME"];
        $host = $_ENV["HOST"];
        $post = $_ENV["PORT"];
        $charset = $_ENV["CHARSET"];
        $username = $_ENV["USERNAME"];
        $password = $_ENV["PASSWORD"];
        $dsn="mysql:host=".$host.";port=".$post.";dbname=".$dbname.";charset=".$charset;
        $db = new PDO($dsn,$username,$password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       return $db;
    }
}