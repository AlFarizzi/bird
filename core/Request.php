<?php
namespace app\core;

use PDO;
use Exception;
use app\core\Connection;
use app\exception\ValidationException;
use PDOException;

class Request {
    static array $errors = [];
    static function validate($rules, $request) {
        foreach ($rules as $key => $rule) {
            foreach ($rules[$key] as $key2 => $item) {
                if($item === "required") {
                    if(is_null($request->$key) || trim($request->$key) === "") {
                        throw new ValidationException("The $key Field Is Required");
                    }
                } else if(explode(":",$item)[0] === "min") {
                    $rule = explode(":",$item);
                    $str_length = count(str_split($request->$key));
                    if($str_length < $rule[1]) {
                        throw new ValidationException("The $key Field Min $rule[1] Character");
                    }
                } else if(explode(":",$item)[0] === "max") {
                    $rule = explode(":",$item);
                    $str_length = count(str_split($request->$key));
                    if($str_length > $rule[1]) {
                        throw new ValidationException("The $key Field Max $rule[1] Character");
                    }
                } 
            }
        }
    }

    static function getErrors() {
        if(isset($_COOKIE["Errors"])) {
            return $_COOKIE["Errors"];
        }
    }

    static function buildInsertQuery($data,$table) {
        $query = "INSERT INTO $table (`id`, ";
        foreach ($data as $key => $item) {
            $query .= "`$key`,";
        }
        $query .= ")";
        $query = explode(",)",$query)[0].')';
        $query .= " VALUES (:id, ";
        foreach ($data as $key => $item) {
            $query .= ":$key,";
        }
        $query .= ")";
        $query = explode(",)",$query)[0].')';
        return $query;
    }

    static function buildExecuteArray($data) {
        $exec = ["id" => null];
        foreach ($data as $key => $item) {
            $exec[$key] = $item;
        }
        return $exec;
    }

    static function create($data,$table) {
        try {
            $con = new Connection();
            $db = $con->connection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = Request::buildInsertQuery($data,$table);
            $exec = Request::buildExecuteArray($data);
            $stmt = $db->prepare($query);
            $stmt->execute($exec);
            header("Location:".$_SERVER["HTTP_REFERER"]);
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}