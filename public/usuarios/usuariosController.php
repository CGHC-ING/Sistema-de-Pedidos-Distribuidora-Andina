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

    public function ingresar()
    {
        if(isset($_POST)){
            $usuario = new Usuarios();
            $datos = $usuario->validarUsuario($_POST['email'], $_POST['password']);
            if($datos == 0){
                $_SESSION['error'] = "No hay usuarios registrados con esos datos";            
                header("Location:/login");
                exit();
            }
            if($datos == 2){
                $_SESSION['error'] = "La contraseña no coincide con la información"; 
                header("Location:/login");
                exit();
            }
            if(isset($datos)){
                $_SESSION['user'] = $datos;
                match ($datos['rol']) {
                    'Admin'=> $_SESSION['admin'] = 1,
                    'Vendedor'=> $_SESSION['vendedor'] = 1,
                    'Bodega'=> $_SESSION['bodega'] = 1
                };
                header("Location:/inicio");
                exit();
            }
        }
    }

    public function cerrarIngreso()
    {
        if(isset($_SESSION['user'])){
            unset($_SESSION['user']);
        }
        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
        }
        if(isset($_SESSION['vendedor'])){
            unset($_SESSION['vendedor']);
        }
        if(isset($_SESSION['bodega'])){
            unset($_SESSION['bodega']);
        }
        header("Location:/");
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
