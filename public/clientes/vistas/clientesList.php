<?php
require_once ('includes/plantilla/menu/menu.php');
?>
<div class="col-md-12">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <?php if(isset($_SESSION['admin']) || isset($_SESSION['vendedor'])){ ?>
            <form action="crear" method="post">
                <input class="btn btn-primary" type="submit" value="Crear Clientes">
            </form>
        <?php } ?>
    </div>
    <div>&nbsp;</div>
    <?php
        if(isset($_SESSION['error'])){
            echo '<div class="alert alert-danger" role="alert">
                    '.$_SESSION['error'].'
                </div>';
            unset($_SESSION['error']);
        }
        if(isset($_SESSION['confirmar'])){
            echo '<div class="alert alert-success" role="alert">
                    '.$_SESSION['confirmar'].'
                </div>';
            unset($_SESSION['confirmar']);
        }
    ?>
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
            <?php if(isset($_SESSION['admin']) || isset($_SESSION['vendedor'])){ ?>
                <th scope="col">Modificar</th>
            <?php } ?>
            <?php if(isset($_SESSION['admin'])){ ?>
                <th scope="col">Activar/Deshabilitar</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php
            if(isset($clientes) && !empty($clientes)){
                $cont = 1;
                foreach ($clientes as $key => $cliente) {
                    echo "<tr>";
                        echo "<td>".$cont."</td>";
                        echo "<td>".$cliente['nit']."</td>";
                        echo "<td>".$cliente['razon_social']."</td>";
                        echo "<td>".$cliente['ciudad']."</td>";
                        echo "<td>".$cliente['tipo']."</td>";
                        echo "<td>".$cliente['cupo_credito']."</td>";
                        if(isset($_SESSION['admin']) || isset($_SESSION['vendedor'])){
                            echo "<td><form action='editar' method='post'><input type='hidden' name='id' value='".$cliente['id']."'><input type='submit' value='Modificar'></form></td>";
                        }
                        if(isset($_SESSION['admin'])){
                            if($cliente['activo'] == 1){
                                echo "<td><form action='cambiarEstado' method='post'><input type='hidden' name='id' value='".$cliente['id']."'><input type='hidden' name='estado' value='0'><input type='submit' value='Deshabilitar'></form></td>";
                            }else{
                                echo "<td><form action='cambiarEstado' method='post'><input type='hidden' name='id' value='".$cliente['id']."'><input type='hidden' name='estado' value='1'><input type='submit' value='Activar'></form></td>";
                            }
                        }
                        $cont++;
                    echo "</tr>";
                }
            }else{
                echo '<tr><td colspan=6>No hay clientes registrados en el sistema</td></tr>';
            }
        ?>
    </tbody>
</table>

<?php
require_once ('includes/plantilla/footer/footer.html');
?>
