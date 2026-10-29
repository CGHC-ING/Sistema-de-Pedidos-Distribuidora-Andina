<?php
require_once ('includes/plantilla/menu/menu.php');
?>

<form action="<?php echo (isset($action)) ?  $action : '';?>" method="post">
    <div class="col-md-4">
        <label for="inputNit" class="form-label" required>Nit <span style="color: red;">*</span></label>
        <input type="text" required name="nit" class="form-control" value="<?php echo (isset($info['nit'])) ?  $info['nit'] : '';?>">
    </div>
    <div class="col-md-4">
        <label for="inputRazon" class="form-label" required>Razon Social <span style="color: red;">*</span></label>
        <input type="text" required name="razon" class="form-control" value="<?php echo  (isset($info['nit'])) ?  $info['razon_social'] : '';?>">
    </div>
    <div class="col-md-4">
        <label for="inputCupo" class="form-label" required>Cupo Credito <span style="color: red;">*</span></label>
        <input type="number" required name="cupo" class="form-control" value="<?php echo (isset($info['cupo_credito'])) ?  $info['cupo_credito'] : '';?>">
    </div>
    <div class="col-md-4">
        <label for="inputCiudad" class="form-label">Ciudad <span style="color: red;">*</span></label>
        <select name="ciudad" id="ciudad" class="form-control" required>
            <option value="">Seleccione...</option>
            <?php
                if(isset($ciudades)){
                    $select = '';
                    foreach ($ciudades as $key => $ciudad) {
                        if(isset($info['ciudad_id'])){
                            if($info['ciudad_id'] == $ciudad['id']){
                                $select = "selected";
                            }else{
                                $select = "";
                            }
                        }
                        echo "<option ".$select." value=".$ciudad['id'].">".$ciudad['nombre']."</option>";
                    }
                }
            ?>
        </select>
    </div>
    <div class="col-md-4">
        <label for="inputTipo" class="form-label">Tipo <span style="color: red;">*</span></label>
        <select name="tipo" id="tipo" class="form-control" required>
            <option value="">Seleccione...</option>
            <option <?php echo (isset($info['tipo']) && $info['tipo'] == 'minorista') ? 'selected' : '';?> value="minorista">Minorista</option>
            <option <?php echo (isset($info['tipo']) && $info['tipo'] == 'mayorista') ? 'selected' : '';?> value="mayorista">Mayorista</option>
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
