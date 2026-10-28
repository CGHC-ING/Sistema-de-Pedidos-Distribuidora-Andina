<?php

spl_autoload_register(function ($class_name) {
    $directorio = match ($class_name) {
        'usuariosController'=> 'usuarios',
        'clientesController'=> 'clientes',
        'productosController' => 'productos'
    };


    $archivo = __DIR__ . '/'.$directorio.'/'. $class_name . '.php';

    if(file_exists($archivo)){
        require_once $archivo;
    }
});

?>