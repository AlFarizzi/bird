<?php
namespace app\core;
require 'config.php';
use PDO;

class Connection {
    public function connection(
        string $dbname = DB_NAME,string $username = USERNAME, 
        string $password = PASSWORD
        ) {
        $dsn="mysql:host=".HOST.";port=".PORT.";dbname=".$dbname.";charset=".CHARSET;
        $db = new PDO($dsn,$username,$password);
       return $db;
    }
}