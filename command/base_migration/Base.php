<?php
require '../../core/MigrationBuilder.php';
use app\core\MigrationBuilder;

$table_name = "Nama Table";
$array = [
    "id" => ["INT(100)", "NOT NULL", "AUTO_INCREMENT"],
    "nama" => ["VARCHAR(100)", "NOT NULL"],
    "PRIMARY KEY" => [("id")]
]; 

$build = new MigrationBuilder();
$build->buildStr($array, $table_name);