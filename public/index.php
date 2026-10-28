<?php
date_default_timezone_set('America/Bogota');
require_once __DIR__ . '/autoload.php';

$url = '';
if(isset($_GET['url'])){
    //Dividir la url por ubicacion y por accion
    $divisionUrl = explode('/',$_GET['url']);
    
    if(is_array($divisionUrl)){
        $conteoPartes = count($divisionUrl);
        if($conteoPartes == 2){

            $controller = $divisionUrl[0]."Controller";
            $accion = $divisionUrl[1];
            $controller =  new $controller();
            $controller->$accion();


        }else if($conteoPartes > 2){
            $url = '';
        } 
        else{
            $url = $_GET['url'];
        }
    }else{
        $url = $_GET['url'];
    }
}else{
    $url = 'login';
}


//$redireccion =  match ($url){
//    'login' => require_once __DIR__ . '/login.php',
//    'usuarios' => require_once __DIR__ . '/usuarios/formularios/usuariosForm.php',
//    '' => require_once __DIR__ . '/index.php'
//};



?>