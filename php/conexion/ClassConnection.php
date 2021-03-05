<?php

class connectionDB extends mysqli
{
    private $DB_HOST = 'localhost';
    //private $DB_HOST = 'node59495-nom-035.jelastic.saveincloud.net';
    private $DB_USER = 'root';
    private  $DB_PASS = 'admin';
    //private $DB_PASS = 'OHOlbv83511';
    private $DB_NAME = 'norma035db';
    private $conn;

    public function __construct()
    {
        try{
  
            $this->conn = new PDO("mysql:host=$this->DB_HOST;charset=UTF8;dbname=$this->DB_NAME",$this->DB_USER,$this->DB_PASS);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
        }catch(PDOException $ex){
  
            die($ex->getMessage());
        }
    }

    public function get_connection()
    {
        return $this->conn;
    }
}
