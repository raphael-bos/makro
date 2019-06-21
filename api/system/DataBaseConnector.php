<?php
namespace System;

class DatabaseConnector {

    private $dbConnection = null;

    public function __construct(){
        try {
            $database = parse_ini_file("config.ini");

            $host = $database["host"];
            $port = $database["port"];
            $dbname = $database["dbname"];
            $user = $database["user"];
            $pass = $database["pass"];

            $this->dbConnection = new \PDO(
                "mysql:host=$host;port=$port;charset=utf8mb4;dbname=$dbname",
                $user,
                $pass
            );
        } catch (Exception $e) {
            return($e);  
        }
    }

    public function getConnection(){
        return $this->dbConnection;
    }
}
?>