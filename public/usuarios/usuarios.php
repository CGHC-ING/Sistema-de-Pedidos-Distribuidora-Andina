<?php
require_once ('includes/conexion/conexion.php');
class Usuarios 
{
    private $id;
    private $nombre;
    private $email;
    private $password_hash;
    private $rol;
    private $activo;
    protected $conexion;

    public function __construct()
    {
        $this->conexion = new conexion();
    }

    public function guardar($data)
    {
        $this->nombre = $data['nombre'];
        $this->email = $data['email'];
        $this->rol = $data['rol'];
        $this->password_hash = password_hash($data['password'],PASSWORD_BCRYPT,["cost" => 4]);
        $db = $this->conexion->conectar();
        $sql = "INSERT INTO usuarios(nombre,email,password_hash,rol,activo) VALUES (:nombre, :email, :password_hash, :rol, :activo)";
        if($db != 0){
            $ejecutar = $db->prepare($sql);
            $ejecutar->execute([
                'nombre' =>  $this->nombre,
                'email'  =>  $this->email,
                'password_hash'   => $this->password_hash,
                'rol' => $this->rol,
                'activo' => 1
            ]);
            if($ejecutar->rowCount() > 0){
                echo "Se ha creado el usuario correctamente";
            }else{
                echo "No se creo el regsitro";
            }
        }

    }

}
