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

    /**
     * buildInsertQuery
     *
     * @param  array $data
     * @param   string $table
     * @return string
     */
    static function buildInsertQuery(array $data,string $table) {
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
    
    /**
     * buildExecuteArray
     *
     * @param  array $data
     * @return array
     */
    static function buildExecuteArray(array $data) {
        foreach ($data as $key => $item) {
            $exec[$key] = $item;
        }
        return $exec;
    }
    
    /**
     * create
     *
     * @param  array $data
     * @param  string $table
     * @return void
     */
    static function create(array $data,string $table) {
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
    
    /**
     * buildGetQuery
     *
     * @param  array $params
     * @return string
     */
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
}