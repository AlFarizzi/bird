<?php
namespace app\core;
require 'Connection.php';
use app\core\Connection;
use PDO;

class MigrationBuilder {
    public function buildStr(array $fields, string $table_name) {
        $str = "CREATE TABLE $table_name (";
        foreach ($fields as $key => $item) {
            $str .= $key;
            foreach ($fields[$key] as $key2 => $item2) {
                if($key === "PRIMARY KEY") {
                    $str.=" ($item2) ";
                } else {
                    $str.=" $item2 ";
                }
            }
            $str.=',';
        }
        $str.=")";
        $str = explode(",)",$str)[0];
        $str.=")";
        $this->execute($str);
    }


    public function execute($query) {
        $con = new Connection();
        $db = $con->connection();
        $stmt = $db->prepare($query);
        $stmt->execute();
    }
}