<?php
require_once ('includes/plantilla/menu/menu.php');
?>
<div class="col-md-12">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <?php if(isset($_SESSION['admin'])){ ?>
            <form action="crear" method="post">
                <input class="btn btn-primary" type="submit" value="Crear Productos">
            </form>
        <?php } ?>
    </div>
    <div>&nbsp;</div>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">SKU</th>
            <th scope="col">Nombre</th>
            <th scope="col">Categoria</th>
            <th scope="col">Precio unitario</th>
            <th scope="col">Exento Iva</th>
            <th scope="col">Stock</th>
            <th scope="col">Stock Minimo</th>
            <?php if(isset($_SESSION['admin'])){ ?>
                <th scope="col">Modificar</th>
            <?php } ?>
            <?php if(isset($_SESSION['admin'])){ ?>
                <th scope="col">Activar/Deshabilitar</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php
            if(isset($productos) && !empty($productos)){
                $cont = 1;
                foreach ($productos as $key => $producto) {
                    echo "<tr>";
                        echo "<td>".$cont."</td>";
                        echo "<td>".$producto['sku']."</td>";
                        echo "<td>".$producto['nombre']."</td>";
                        echo "<td>".$producto['categoria']."</td>";
                        echo "<td>".$producto['precio']."</td>";
                        echo "<td>".$producto['exento_iva']."</td>";
                        echo "<td>".$producto['stock']."</td>";
                        echo "<td>".$producto['stock_minimo']."</td>";
                        if(isset($_SESSION['admin'])){
                            echo "<td><form action='editar' method='post'><input type='hidden' name='id' value='".$producto['id']."'><input type='submit' value='Modificar'></form></td>";
                        }
                        if(isset($_SESSION['admin'])){
                            if($producto['activo'] == 1){
                                echo "<td><form action='cambiarEstado' method='post'><input type='hidden' name='id' value='".$producto['id']."'><input type='hidden' name='estado' value='0'><input type='submit' value='Deshabilitar'></form></td>";
                            }else{
                                echo "<td><form action='cambiarEstado' method='post'><input type='hidden' name='id' value='".$producto['id']."'><input type='hidden' name='estado' value='1'><input type='submit' value='Activar'></form></td>";
                            }
                        }
                        $cont++;
                    echo "</tr>";
                }
            }else{
                echo "<td colspan = '10'>No se han encontrado regsitros de productos</td>";
            }
        ?>
    </tbody>
</table>

<?php
require_once ('includes/plantilla/footer/footer.html');
?>
