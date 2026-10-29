<?php
require_once ('includes/conexion/conexion.php');
class productos 
{
    private $id;
    private $sku;
    private $nombre;
    private $categoria_id;
    private $precio;
    private $exento_iva;
    private $stock;
    private $stock_minimo;
    private $activo;
    protected $conexion;

    public function __construct()
    {
        $this->conexion = new conexion();
    }

    public function listar()
    {
        $sql = "SELECT productos.id, sku, productos.nombre, precio, exento_iva, stock, stock_minimo, activo, categorias.nombre AS categoria FROM productos INNER JOIN categorias ON categorias.id = productos.categoria_id WHERE activo = :activo ORDER BY sku ASC";
        $db = $this->conexion->conectar();
        if($db != 0){
            $ejecutar = $db->prepare($sql);
            $ejecutar->execute([
                'activo' =>  1,
            ]);
            $resultados = $ejecutar->fetchAll(PDO::FETCH_ASSOC);
            $total = count($resultados);
            if($total == 0){
                return 0;
            }
            return $resultados;
        }
    }

    public function guardar($data)
    {
        $this->sku = $data['sku'];
        $this->nombre = $data['nombre'];
        $this->categoria_id = $data['categoria'];
        $this->precio = $data['precio'];
        $this->exento_iva = $data['exento'];
        $this->stock = $data['stock'];
        $this->stock_minimo = $data['minimo'];
        $this->activo = 1;
        $db = $this->conexion->conectar();
        $sql = "INSERT INTO productos(sku,nombre,categoria_id,precio,exento_iva,stock,stock_minimo,activo) VALUES (:sku, :nombre, :categoria, :precio, :exento, :stock, :minimo, :activo)";
        if($db != 0){
            $ejecutar = $db->prepare($sql);
            $ejecutar->execute([
                'sku' =>  $this->sku,
                'nombre'  =>  $this->nombre,
                'categoria'   => $this->categoria_id,
                'precio' => $this->precio,
                'exento' => $this->exento_iva,
                'stock'  => $this->stock, 
                'minimo' => $this->stock_minimo,
                'activo' => $this->activo
            ]);
            if($ejecutar->rowCount() > 0){
                return $db->lastInsertId();
            }else{
                return 0;
            }
        }
    }

    public function buscar($id)
    {
        $this->id = $id;
        $sql = "SELECT * FROM productos WHERE id = :id";
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
        $this->sku = $data['sku'];
        $this->nombre = $data['nombre'];
        $this->categoria_id = $data['categoria'];
        $this->precio = $data['precio'];
        $this->exento_iva = $data['exento'];
        $this->stock = $data['stock'];
        $this->stock_minimo = $data['minimo'];
        $this->activo = 1;
        $db = $this->conexion->conectar();
        $sql = "UPDATE productos SET sku = :sku ,nombre = :nombre ,categoria_id = :categoria ,precio = :precio ,exento_iva = :exento, stock = :stock,stock_minimo = :minimo,activo = :activo WHERE id = :id";
        if($db != 0){
            $ejecutar = $db->prepare($sql);
            $ejecutar->execute([
                'id' => $this->id,
                'sku' =>  $this->sku,
                'nombre'  =>  $this->nombre,
                'categoria'   => $this->categoria_id,
                'precio' => $this->precio,
                'exento' => $this->exento_iva,
                'stock'  => $this->stock, 
                'minimo' => $this->stock_minimo,
                'activo' => $this->activo
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
        $sql = "UPDATE productos SET activo = :estado WHERE id = :id";
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
