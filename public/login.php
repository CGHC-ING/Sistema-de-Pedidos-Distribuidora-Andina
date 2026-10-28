<?php
require_once ('includes/plantilla/header/header.html');
?>
<body>
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="container">
            <div class="card">
                <div class="card-header">
                        <h4>Por favor ingrese su correo y su contraseña para acceder</h4>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Correo:</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Contraseña:</label>
                            <input type="password" class="form-control"  id="password" name="password">
                        </div>
                        <div class="form-group form-check">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Ingresar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
require_once ('includes/plantilla/footer/footer.html');
?>
