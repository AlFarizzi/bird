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
        $query .= " VALUES (null, ";
        foreach ($data as $key => $item) {
            $query .= ":$key,";
        }
        $query .= ")";
        $query = explode(",)",$query)[0].')';
        return $query;
    }

    static function buildExecuteArray($data) {
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

    static function buildGetQuery(string $table,array $params) {
        if(count($params) === 0) {
            return "SELECT * FROM $table";
        } else {
            $query = "SELECT id, ";
            for ($i=0; $i < count($params); $i++) { 
                if($i === count($params) - 1) {
                    $query .= "$params[$i] ";
                } else {
                    $query .= "$params[$i], ";
                }
            }
            $query .= "FROM $table";
            return $query;
        }
    }

    static function get(string $table,array $fields = []) {
        try {
            //code...
            $result = [];
            $conn = new Connection();
            $db = $conn->connection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = static::buildGetQuery($table,$fields);
            $stmt = $db->prepare($query);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                $result [] = $row; 
            }
            return $result;
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
        
    }

    static function buildWhereQuery(string $query,array $selector) {
        if(count($selector) > 3 && count($selector) % 3 === 0) {
            $query .= " WHERE "; 
            for ($i=0; $i < count($selector); $i++) { 
                $query .= " $selector[0] $selector[1] '$selector[2]'";
                    for ($j=0; $j < 3; $j++) { 
                        array_shift($selector);
                    }
                if($i < count($selector)) {
                    $query .= " AND  ";
                }
            }
            return $query;
        } else {
            $query .= " WHERE $selector[0] $selector[1] '$selector[2]' ";
            return $query;
        }
    }

    static function where(string $table, array $selector, array $fields = []) {
        try {
            $result = [];
            $conn = new Connection();
            $db = $conn->connection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = Request::buildGetQuery($table,$fields);
            $query = Request::buildWhereQuery($query, $selector);
            $stmt = $db->prepare($query);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                $result [] = $row;
            }
            return $result;
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}