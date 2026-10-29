<?php
require_once ('includes/plantilla/header/header.html');
?>
<body>
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="container shadow p-4 mb-5 bg-body rounded">
            <div class="col-md-12">
                <div class="col-md-6">
                    <form action="crear" method="post">
                        <input class="btn btn-primary" type="submit" value="Crear Clientes">
                    </form>
                </div>
                <div>&nbsp;</div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nit</th>
                        <th scope="col">Razon Social</th>
                        <th scope="col">Ciudad</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Cupo de Credito</th>
                        <th scope="col">Modificar</th>
                        <th scope="col">Desactivar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($clientes)){
                            $cont = 1;
                            foreach ($clientes as $key => $cliente) {
                                echo "<tr>";
                                    echo "<td>".$cont."</td>";
                                    echo "<td>".$cliente['nit']."</td>";
                                    echo "<td>".$cliente['razon_social']."</td>";
                                    echo "<td>".$cliente['ciudad']."</td>";
                                    echo "<td>".$cliente['tipo']."</td>";
                                    echo "<td>".$cliente['cupo_credito']."</td>";
                                    echo "<td><form action='editar' method='post'><input type='hidden' name='id' value='".$cliente['id']."'><input type='submit' value='Modificar'></form></td>";
                                    if($cliente['activo'] == 1){
                                        echo "<td><form action='cambiarEstado' method='post'><input type='hidden' name='id' value='".$cliente['id']."'><input type='hidden' name='estado' value='0'><input type='submit' value='Deshabilitar'></form></td>";
                                    }else{
                                        echo "<td><form action='cambiarEstado' method='post'><input type='hidden' name='id' value='".$cliente['id']."'><input type='hidden' name='estado' value='1'><input type='submit' value='Activar'></form></td>";
                                    }
                                    $cont++;
                                echo "</tr>";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
require_once ('includes/plantilla/footer/footer.html');
?>
