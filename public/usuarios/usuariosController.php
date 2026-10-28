<?php
require_once __DIR__ . '/usuarios.php';
class UsuariosController
{
    
    public function crear()
    {
        require_once __DIR__ . '/vistas/formularios/usuariosForm.php';
    }

    public function registrar()
    {
        if(isset($_POST)){
            $validacion = $this->validarCampos($_POST);
            if($validacion == 1){
                $usuario = new Usuarios();
                $usuario->guardar($_POST);
                
            }else{

                echo "No ha llenado la informacion correctamente ";
            }
        }
    }

    public function validarCampos($data)
    {
        $validacion = 1;
        if(empty($data['email'])){
            $validacion = 0;
        }else{
            $validacion = $this->validacionEmail($data['email']);
        }
        if(empty($data['nombre'])){
            $validacion = 0;
        }
        if(empty($data['password'])){
            $validacion = 0;
        }
        if(empty($data['rol'])){
            $validacion = 0;
        }
        return $validacion;
    }
    public function validacionEmail($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return 1;
        }else{
            return 0;
        }
    }
}
