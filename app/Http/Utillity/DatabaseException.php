<?php
namespace App\Http\Utillity;

use Exception;

class DatabaseException extends Exception{
    //use non default constructor
    public function __construct($message, $code = 0, Exception $previous = null){
        //call super class
        parent::__construct($message, $code , $previous);
    }
}