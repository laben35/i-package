<?php

namespace Lib\Manager;
use PDO;

class Manager {
    
    private static $instance;
    
    private $credential;
    
    private $dbh;
    
   
    private function __construct() {
    
        $this->credential = [
            "driver" => "mysql:host=localhost",
            "dbname" => "find_code",
            "charset" => "utf8",
            "username" => "root",
            "password" => "",
       ];
    }
    
    
    public static function getInstance() {
        
        if(null === self::$instance) {
            
            self::$instance = new Manager();
        }
        
        return self::$instance;
    }
    
     public static function getPdo()
     {
           if (null === self::getInstance()->dbh) {
               self::$instance->dbh = new PDO (
                  self::$instance->credential["driver"]
                . "; dbname="
                . self::$instance->credential["dbname"]
                . "; charset="
                . self::$instance->credential["charset"],
                 self::$instance->credential["username"],
                 self::$instance->credential["password"], [ 
                     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION                   
                 ]
               );
        }
        return self::$instance->dbh;
    }

}
