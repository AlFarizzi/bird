<?php
require '../../core/MigrationBuilder.php';
use app\core\MigrationBuilder;

$table_name = "Nama Table";
$array = [
    "id" => ["INT(100)", "UNSIGNED", "NOT NULL"],
    "nama" => ["VARCHAR(100)", "NOT NULL"],
    "PRIMARY KEY" => [("id")]
]; 

$build = new MigrationBuilder();
$build->buildStr($array, "Users");