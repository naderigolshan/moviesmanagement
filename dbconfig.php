<?php

class Database {

    private $_connection;
    private static $_instance; 
    private $host = "localhost";
    private $db_name = "dblogin";
    private $username = "root";
    private $password = "";

    public static function getInstance() {
        if (!self::$_instance) { 
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct() {
        $this->_connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        $this->_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Error handling
        if (mysqli_connect_error()) {
            trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(), E_USER_ERROR);
        }
    }

    private function __clone() {
        
    }

    public function getConnection() {
        return $this->_connection;
    }

}

?>