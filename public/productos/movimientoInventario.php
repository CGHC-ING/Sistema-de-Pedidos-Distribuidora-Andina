<?php
require_once ('includes/conexion/conexion.php');
class movimientoInventario
{
    private $id;
    private $producto_id;
    private $usuario_id;
    private $pedido_id;
    private $tipo;
    private $cantidad;
    private $creado_en;
    protected $conexion;
    
    public function __construct()
    {
        $this->conexion = new conexion();
    }

    public function guardar($data)
    {
        $this->producto_id = $data['id'];
        $this->usuario_id = $data['user'];
        $this->pedido_id = $data['pedido'];
        $this->tipo = $data['tipo'];
        $this->cantidad = $data['cantidad'];
        $this->creado_en = $this->crearFecha();
        $db = $this->conexion->conectar();
        $sql = "INSERT INTO movimientos_inventario(producto_id,usuario_id,pedido_id,tipo,cantidad,creado_en) VALUES (:producto, :usuario, :pedido, :tipo, :cantidad, :creado_en)";
        if($db != 0){
            $ejecutar = $db->prepare($sql);
            $ejecutar->execute([
                'producto' =>  $this->producto_id,
                'usuario'  =>  $this->usuario_id,
                'pedido'   => $this->pedido_id,
                'tipo' => $this->tipo,
                'cantidad' => $this->cantidad,
                'creado_en'  => $this->creado_en, 
            ]);
            if($ejecutar->rowCount() > 0){
                return 1;
            }else{
                return 0;
            }
        }

    }

    public function crearFecha()
    {
        $fecha = new DateTime();
        return $fecha->format('Y-m-d H:i:s');
    }
}
