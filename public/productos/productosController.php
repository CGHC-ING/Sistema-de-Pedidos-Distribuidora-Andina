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
        if(isset($_SESSION['admin'])){
            $data = new categorias();
            $categorias = $data->listado();
            $proActive = "active";
            $action = '/productos/registrar';
            require_once __DIR__ . '/vistas/formularios/productosForm.php';
        }else{
            http_response_code(403);
            require_once 'includes/plantilla/error403.html';
        }
    }
    public function registrar()
    {
        if(isset($_SESSION['admin'])){
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
                    if(empty($proceso)){
                        $_SESSION['error'] = 'No se pudo realizar la insercion del registro';
                    }else{
                        $_SESSION['confirmar'] = 'Se ha creado correctamente el registro';
                    }
                }
                header("Location:/productos/listado");
                exit();    
            }
        }else {
            http_response_code(403);
            require_once 'includes/plantilla/error403.html';
        }
    }

    public function editar()
    {
        if(isset($_SESSION['admin'])){
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
        }else{
            http_response_code(403);
            require_once 'includes/plantilla/error403.html';
        }

    }

    public function modificar()
    {
        if(isset($_SESSION['admin'])){
            $id = $_POST['id'];
            if(is_numeric($id)){
                $data = new productos();
                $info = $data->buscar($id);
                if(!empty($info)){
                    $resultado = $data->modificarInformacion($_POST);
                    if(empty($resultado)){
                        $_SESSION['error'] = 'No se pudo realizar la actualización del registro';
                    }else{
                        $_SESSION['confirmar'] = 'Se ha modificado correctamente el registro';
                    }
                }
                header("Location:/productos/listado");
                exit();
            }
        }else{
            http_response_code(403);
            require_once 'includes/plantilla/error403.html';
        }
    }

    public function cambiarEstado()
    {
        if(isset($_SESSION['admin'])){
            $estado = $_POST['estado'];
            $id = $_POST['id'];
            if(is_numeric($id)){
                $data = new productos();
                $info = $data->buscar($id);
                if(!empty($info)){
                    $resultado = $data->modificarEstado($id, $estado);
                    if(!empty($resultado)){
                        $_SESSION['confirmar'] = 'Se ha cambiado el estado del registro';
                    }else{
                        $_SESSION['error'] = 'No se pudo realizar el cambio de estado al registro';
                    }
                }
                header("Location:/productos/listado");
                exit();
            }
        }else{
            http_response_code(403);
            require_once 'includes/plantilla/error403.html';
        }
    }

}
