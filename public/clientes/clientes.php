<?php
require_once ('includes/conexion/conexion.php');
class clientes
{
    private $id;
    private $nit;
    private $razon_social;
    private $tipo;
    private $cupo_credito;
    private $ciudad_id;
    private $activo;
    protected $conexion;

    public function __construct()
    {
        $this->conexion = new conexion();
    }

    public function listar()
    {
        $sql = "SELECT clientes.id,clientes.nit,clientes.razon_social,clientes.tipo,clientes.cupo_credito,clientes.activo,ciudades.nombre AS ciudad FROM clientes INNER JOIN ciudades ON ciudades.id = clientes.ciudad_id";
        $db = $this->conexion->conectar();
        $sqlExec = $db->query($sql);
        $data = $sqlExec->fetchAll(PDO::FETCH_ASSOC);

        if(empty($data)){
            return 0;
        }
        return $data;

    }

    public function guardar($data)
    {
        $this->nit = $data['nit'];
        $this->razon_social = $data['razon'];
        $this->tipo = $data['tipo'];
        $this->cupo_credito = $data['cupo'];
        $this->ciudad_id = $data['ciudad'];
        $this->activo = 1;
        $db = $this->conexion->conectar();
        $sql = "INSERT INTO clientes(ciudad_id,nit,razon_social,tipo,cupo_credito,activo) VALUES (:ciudad, :nit, :razon, :tipo, :cupo, :activo)";
        if($db != 0){
            $ejecutar = $db->prepare($sql);
            $ejecutar->execute([
                'ciudad' =>  $this->ciudad_id,
                'nit'  =>  $this->nit,
                'razon'   => $this->razon_social,
                'tipo' => $this->tipo,
                'cupo' => $this->cupo_credito,
                'activo' => 1
            ]);
            if($ejecutar->rowCount() > 0){
                return 1;
            }else{
                return 0;
            }
        }
    }
    public function buscar($id)
    {
        $this->id = $id;
        $sql = "SELECT * FROM clientes WHERE id = :id";
        $db = $this->conexion->conectar();
        if($db != 0){
            $ejecutar = $db->prepare($sql);
            $ejecutar->execute([
                'id' =>  $this->id,
            ]);
            $resultados = $ejecutar->fetch(PDO::FETCH_ASSOC);
            $total = count($resultados);
            if($total == 0){
                return 0;
            }
            return $resultados;
        }
    }
    public function modificarInformacion($data)
    {
        $this->id = $data['id'];
        $this->nit = $data['nit'];
        $this->razon_social = $data['razon'];
        $this->tipo = $data['tipo'];
        $this->cupo_credito = $data['cupo'];
        $this->ciudad_id = $data['ciudad'];
        $this->activo = 1;
        $db = $this->conexion->conectar();
        $sql = "UPDATE clientes SET ciudad_id = :ciudad ,nit = :nit ,razon_social = :razon ,tipo = :tipo ,cupo_credito = :cupo WHERE id = :id";
        if($db != 0){
            $ejecutar = $db->prepare($sql);
            $ejecutar->execute([
                'ciudad' =>  $this->ciudad_id,
                'nit'  =>  $this->nit,
                'razon'   => $this->razon_social,
                'tipo' => $this->tipo,
                'cupo' => $this->cupo_credito,
                'id' => $this->id
            ]);
            if($ejecutar->rowCount() > 0){
                return 1;
            }else{
                return 0;
            }
        }


    }

    public function modificarEstado($id, $estado)
    {
        $this->id = $id;
        $this->activo = $estado;
        $sql = "UPDATE clientes SET activo = :estado WHERE id = :id";
        $db = $this->conexion->conectar();
        if($db != 0){
            $ejecutar = $db->prepare($sql);
            $ejecutar->execute([
                'id' =>  $this->id,
                'estado' => $this->activo
            ]);
            if($ejecutar->rowCount() > 0){
                return 1;
            }else{
                return 0;
            }
        }
    }
}
