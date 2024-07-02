<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

class DatabaseConnection
{
    private $user;
    private $password;
    private $database;
    private $host;

    public function __construct()
    {
        $this->user     = "levelhard05";
        $this->password = "********";
        $this->database = "levelhard05";
        $this->host     = "mysql.levelhard.com.br";

        $this->mysqli = new mysqli($this->host, $this->user, $this->password, $this->database);
        if (mysqli_connect_errno()) {
            die('FATAL ERROR: Can not connect to SQL Server.');
            exit();
        }
    }

    public function _query($qr)
    {
        $this->result = $this->mysqli->query($qr);
        return $this->result;
    }

    public function _close()
    {
        $this->mysqli->close();
    }
}

?>