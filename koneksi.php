<?php
class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "todolist";
    public $connect;

    // Konstruktor untuk membuat koneksi ke database
    public function __construct()
    {
        $this->connect = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->connect->connect_error) {
            die("Connection failed: " . $this->connect->connect_error);
        }
    }
}
?>