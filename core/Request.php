<?php
namespace app\core;

use app\exception\ValidationException;

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
}