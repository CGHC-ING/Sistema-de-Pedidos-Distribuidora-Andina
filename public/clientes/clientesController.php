<?php

require_once __DIR__ . '/clientes.php';
require_once __DIR__ . '/ciudades.php';
class clientesController 
{
    public function listado()
    {
        $data = new clientes();
        $clientes = $data->listar();
        require_once __DIR__ . '/vistas/clientesList.php';
    }
    public function crear()
    {
        $data = new ciudades();
        $ciudades = $data->listado();
        require_once __DIR__ . '/vistas/formularios/clientesForm.php';
    }
    public function registrar()
    {
        if(isset($_POST)){
            $cliente = new clientes();
            $cliente->guardar($_POST);
            header("Location:/clientes/listado");    
        }
    }

    public function editar()
    {
        $id = $_POST['id'];
        if(is_numeric($id)){
            $data = new ciudades();
            $ciudades = $data->listado();
            $data = new clientes();
            $info = $data->buscar($id); 
            require_once __DIR__ . '/vistas/formularios/clientesForm.php';
        }

    }

    public function cambiarEstado()
    {
        $estado = $_POST['estado'];
        $id = $_POST['id'];
        if(is_numeric($id)){
            $data = new clientes();
            $info = $data->buscar($id);
            if(!empty($info)){
                $data->modificarEstado($id, $estado);
            }
            header("Location:/clientes/listado");

        }
    }

    public function validarCampos($data)
    {

    }

}
