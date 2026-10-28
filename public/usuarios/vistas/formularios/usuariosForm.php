<?php
require_once ('includes/plantilla/header/header.html');
?>
<body>
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="container shadow p-4 mb-5 bg-body rounded">
            <form action="/usuarios/registrar" method="post">
                <div class="col-md-4">
                    <label for="inputEmail" class="form-label" required>Email <span style="color: red;">*</span></label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="inputPassword" class="form-label" required>Contraseña <span style="color: red;">*</span></label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="inputNombre" class="form-label" required>Nombre <span style="color: red;">*</span></label>
                    <input type="text" name="nombre" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="inputRol" class="form-label">Seleccion un rol <span style="color: red;">*</span></label>
                    <select name="rol" id="rol" class="form-control" required>
                        <option value="">Seleccione...</option>
                        <option value="Admin">Administrador</option>
                        <option value="Vendedor">Vendedor</option>
                        <option value="Bodega">Bodega</option>
                    </select>
                </div>
                <div>&nbsp;</div>
                <div class="col-md-12">
                    <input type="submit" class="btn btn-primary" value="Registrar">
                </div>
            </form>
        </div>
    </div>
<?php
require_once ('includes/plantilla/footer/footer.html');
?>
