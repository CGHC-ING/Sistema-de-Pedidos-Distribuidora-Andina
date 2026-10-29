<?php
require_once __DIR__ . '/categorias.php';
require_once __DIR__ . '/productos.php';
require_once __DIR__ . '/movimientoInventario.php';
class productosController 
{
    public function __construct()
    {
        if(!isset($_SESSION['user'])){
            header("Location:/");
        }
    }

    public function listado()
    {
        $data = new productos();
        $proActive = "active";
        $productos = $data->listar();
        require_once __DIR__ . '/vistas/productosList.php';
    }
    public function crear()
    {
        $data = new categorias();
        $categorias = $data->listado();
        $proActive = "active";
        $action = '/productos/registrar';
        require_once __DIR__ . '/vistas/formularios/productosForm.php';
    }
    public function registrar()
    {
        if(isset($_POST)){
            $producto = new productos();
            $ultimoRegistro = $producto->guardar($_POST);
            if(!empty($ultimoRegistro) && $ultimoRegistro != 0){
                $data['cantidad'] = $_POST['stock'];
                $data['user'] = $_SESSION['user']['id'];
                $data['tipo'] = 'entrada';
                $data['producto'] = $ultimoRegistro;
                $inventario = new movimientoInventario();
                $proceso = $inventario->guardar($data);
                if($proceso){
                    //Mensajes de confirmacion
                }
            }
            header("Location:/productos/listado");    
        }
    }

    public function editar()
    {
        $id = $_POST['id'];
        $proActive = "active";
        $action = '/productos/modificar';
        if(is_numeric($id)){
            $data = new categorias();
            $categorias = $data->listado();
            $data = new productos();
            $info = $data->buscar($id); 
            require_once __DIR__ . '/vistas/formularios/productosForm.php';
        }

    }

    public function modificar()
    {
        $id = $_POST['id'];
        if(is_numeric($id)){
            $data = new productos();
            $info = $data->buscar($id);
            if(!empty($info)){
                $data->modificarInformacion($_POST);
            }
            header("Location:/productos/listado");

        }
    }

    public function cambiarEstado()
    {
        $estado = $_POST['estado'];
        $id = $_POST['id'];
        if(is_numeric($id)){
            $data = new productos();
            $info = $data->buscar($id);
            if(!empty($info)){
                $data->modificarEstado($id, $estado);
            }
            header("Location:/productos/listado");

        }
    }

}
