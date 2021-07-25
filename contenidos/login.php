<?php
if ((!empty($_GET['status']) && $_GET['status'] == 'ok')) {
    ?>
    <div class="alert alert-success fade show text-center" role="alert">
    'Gracias! Ya podés iniciar sesión'
    </div>
<?php
} elseif ((!empty($_GET['status']) && $_GET['status'] == 'error')){
    ?>
    <div class="alert alert-danger fade show text-center" role="alert">
        Usuario y/o contraseña incorrectos
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
} elseif ((!empty($_GET['status']) && $_GET['status'] == 'vacio')){
    ?>
    <div class="alert alert-danger fade show text-center" role="alert">
        Enviaste campos vacíos
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
}
?>
<section>
    <form action="procesos/logeo.php" method="POST" class="p-5 w-50 m-auto">
        <div class="form-group">
            <label for="user" class="font-weight-bold">Usuario</label>
            <input type="text" name="user" id="user" class="form-control">
        </div>
        <div class="form-group">
            <label for="pass" class="font-weight-bold">Contraseña</label>
            <input type="password" name="pass" id="pass" class="form-control">
        </div>
        <div class="form-group">
            <input type="checkbox" name="recordarme" id="recordarme" value="true">
            <label for="recordarme" class="font-weight-bold">Recordarme</label>
        </div>

        <button type="submit" class="btn btn-primary mx-auto d-block px-4 mt-5">Iniciar sesión</button>

        <small class="mt-4 col-12 text-center">Registrarse
            <a href="index.php?seccion=registro" class="text-primary font-weight-bold">acá</a></small>

        <small class="mt-4 col-12 text-center">Recuperar Clave
            <a href="index.php?seccion=recuperar_clave" class="text-primary font-weight-bold">acá</a></small>

    </form>
</section>