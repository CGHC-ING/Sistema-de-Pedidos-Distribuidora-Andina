<?php
session_start();
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
        } 
        else{
            if($conteoPartes > 2){
                http_response_code(404);
                require_once __DIR__ . '/includes/plantilla/error404.html';
            }else{
                if(isset($_SESSION['user'])){
                    require_once __DIR__ . '/includes/inicio.php';
                }else{
                    require_once __DIR__ . '/login.php';
                }
            }
        }
    }
}else{
    if(isset($_SESSION['user'])){
        header("Location:/inicio");
    }else{
        require_once __DIR__ . '/login.php';
    }
    
}


?>