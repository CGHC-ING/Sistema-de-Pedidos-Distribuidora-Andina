<?php
class conexion 
{
    private $db;
    private $host;
    private $user;
    private $password;
    private $dns;

    public function __construct()
    {
        
        $this->db = $_ENV['DB_NAME'];
        $this->host = $_ENV['DB_HOST'];
        $this->user = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASSWORD'];
        $this->dns = "mysql:host=$this->host;dbname=$this->db";
    }

    public function conectar()
    {
        try {
            $conexion = new PDO($this->dns,$this->user,$this->password);
            return 1;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

}
