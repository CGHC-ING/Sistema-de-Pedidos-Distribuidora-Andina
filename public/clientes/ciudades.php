<?php
require_once ('includes/conexion/conexion.php');
class ciudades 
{
    private $id;
    private $nombre;
    protected $conexion;

    public function __construct()
    {
        $this->conexion = new conexion();
    }

    public function listado()
    {
        $sql = "SELECT id, nombre FROM ciudades";
        $db = $this->conexion->conectar();
        $sqlExec = $db->query($sql);
        $data = $sqlExec->fetchAll(PDO::FETCH_ASSOC);

        if(empty($data)){
            return 0;
        }
        return $data;

        
    }

}
