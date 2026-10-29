<?php
require_once ('includes/plantilla/menu/menu.php');
?>

<form action="<?php echo (isset($action)) ?  $action : '';?>" method="post">
    <div class="col-md-4">
        <label for="inputSku" class="form-label" required>SKU <span style="color: red;">*</span></label>
        <input type="text" required name="sku" class="form-control" value="<?php echo (isset($info['sku'])) ?  $info['sku'] : '';?>">
    </div>
    <div class="col-md-4">
        <label for="inputNombre" class="form-label" required>Nombre <span style="color: red;">*</span></label>
        <input type="text" required name="nombre" class="form-control" value="<?php echo  (isset($info['nombre'])) ?  $info['nombre'] : '';?>">
    </div>
    <div class="col-md-4">
        <label for="inputPrecio" class="form-label" required>Precio <span style="color: red;">*</span></label>
        <input type="number" required name="precio" class="form-control" value="<?php echo (isset($info['precio'])) ?  $info['precio'] : '';?>">
    </div>
    <div class="col-md-4">
        <label for="inputStock" class="form-label" required>Stock <span style="color: red;">*</span></label>
        <input type="number" required name="stock" class="form-control" value="<?php echo (isset($info['stock'])) ?  $info['stock'] : '';?>">
    </div>
    <div class="col-md-4">
        <label for="inputMinimo" class="form-label" required>Stock Minimo<span style="color: red;">*</span></label>
        <input type="number" required name="minimo" class="form-control" value="<?php echo (isset($info['stock_minimo'])) ?  $info['stock_minimo'] : '';?>">
    </div>
    <div class="col-md-4">
        <label for="inputTipo" class="form-label">Exento de Iva <span style="color: red;">*</span></label>
        <select name="exento" id="tipo" class="form-control" required>
            <option value="">Seleccione...</option>
            <option <?php echo (isset($info['exento_iva']) && $info['exento_iva'] == 1 ) ?  'selected' : '';?> value="1">SI</option>
            <option <?php echo (isset($info['exento_iva']) && $info['exento_iva'] == 2 ) ?  'selected' : '';?> value="2">NO</option>
        </select>
    </div>
    <div class="col-md-4">
        <label for="inputCiudad" class="form-label">Categorias <span style="color: red;">*</span></label>
        <select name="categoria" id="ciudad" class="form-control" required>
            <option value="">Seleccione...</option>
            <?php
                if(isset($categorias)){
                    $select = '';
                    foreach ($categorias as $key => $categoria) {
                        if(isset($info['categoria_id'])){
                            if($info['categoria_id'] == $categoria['id']){
                                $select = "selected";
                            }else{
                                $select = "";
                            }
                        }
                        echo "<option ".$select." value=".$categoria['id'].">".$categoria['nombre']."</option>";
                    }
                }
            ?>
        </select>
    </div>
    <div>&nbsp;</div>
    <?php
    if(isset($info['id'])){
        echo "<input type='hidden' name='id' value='".$info['id']."'>";
    }
    ?>
    <div class="col-md-12">
        <input type="submit" class="btn btn-primary" value="Registrar">
    </div>
</form>

<?php
require_once ('includes/plantilla/footer/footer.html');
?>
