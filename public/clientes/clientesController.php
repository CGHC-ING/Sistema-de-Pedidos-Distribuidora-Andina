<?php

require_once __DIR__ . '/clientes.php';
require_once __DIR__ . '/ciudades.php';
class clientesController 
{
    public function __construct()
    {
        if(!isset($_SESSION['user'])){
            header("Location:/");
        }
    }
    public function listado()
    {
        $data = new clientes();
        $cliActive = "active";
        $clientes = $data->listar();
        require_once __DIR__ . '/vistas/clientesList.php';
    }
    public function crear()
    {
        $data = new ciudades();
        $ciudades = $data->listado();
        $cliActive = "active";
        $action = '/clientes/registrar';
        require_once __DIR__ . '/vistas/formularios/clientesForm.php';
    }
    public function registrar()
    {
        if(isset($_SESSION['admin']) || isset($_SESSION['vendedor'])){
            if(isset($_POST)){
                $cliente = new clientes();
                $validar = $cliente->validarNit($_POST['nit']);
                if($validar){
                    $resultado = $cliente->guardar($_POST);
                    if(empty($resultado)){
                        $_SESSION['error'] = 'No se ha podido crear el cliente';
                    }
                }else{
                    $_SESSION['error'] = 'La empresa ya se ha registrado en el sistema';
                }
                header("Location:/clientes/listado");
                exit();    
            }else{
                header("Location:/clientes/listado");
                exit(); 
            }
        }else{
            http_response_code(403);
            require_once 'includes/plantilla/error403.html';
        }
    }

    public function editar()
    {
        if(isset($_SESSION['admin']) || isset($_SESSION['vendedor'])){
            $id = $_POST['id'];
            $cliActive = "active";
            $action = '/clientes/modificar';
            if(is_numeric($id)){
                $data = new ciudades();
                $ciudades = $data->listado();
                $data = new clientes();
                $info = $data->buscar($id); 
                require_once __DIR__ . '/vistas/formularios/clientesForm.php';
            }
        }else{
            http_response_code(403);
            require_once 'includes/plantilla/error403.html';
        }

    }

    public function modificar()
    {
        if(isset($_SESSION['admin']) || isset($_SESSION['vendedor'])){
            $id = $_POST['id'];
            if(is_numeric($id)){
                $data = new clientes();
                $info = $data->buscar($id);
                if(!empty($info)){
                    $resultado = $data->modificarInformacion($_POST);
                    if(!empty($resultado)){
                        $_SESSION['confirmar'] = 'Se ha modificado correctamente el registro';
                    }else{
                        $_SESSION['error'] = 'No se pudo realizar la actualización del registro';
                    }
                }else{
                    $_SESSION['error'] = 'No se encontro el registro solicitado';
                }
                header("Location:/clientes/listado");
                exit();
            }else{
                http_response_code(403);
                require_once 'includes/plantilla/error403.html';
            }
        }
    }

    public function cambiarEstado()
    {
        if(isset($_SESSION['admin'])){
            $estado = $_POST['estado'];
            $id = $_POST['id'];
            if(is_numeric($id)){
                $data = new clientes();
                $info = $data->buscar($id);
                if(!empty($info)){
                    $resultado = $data->modificarEstado($id, $estado);
                    if(!empty($resultado)){
                        $_SESSION['confirmar'] = 'Se ha cambiado el estado del registro';
                    }else{
                        $_SESSION['error'] = 'No se pudo realizar el cambio de estado al registro';
                    }
                }
                header("Location:/clientes/listado");
                exit();
            }
        }else{
            http_response_code(403);
            require_once 'includes/plantilla/error403.html';
        }
    }

}
