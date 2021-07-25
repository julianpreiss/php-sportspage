<?php
$errores = [];
if (!empty($_GET['campos']))
    $errores = json_decode($_GET['campos']);

$usuario = [];
$accion = 'Agregar';
$archivo = 'alta_usuarios_proceso.php';

if (!empty($_GET['id'])) {
	$id_user_escape = intval($_GET['id']);
    $id_usuario = $id_user_escape;
    $select_usu = "SELECT * 
    FROM usuarios
    WHERE id_usuario=$id_usuario";
    $res_select_usu = mysqli_query($cnx, $select_usu);
    if (!$res_select_usu->num_rows) {
        header('Location: index.php?secciones=usuarios&status=errorenproceso&accion=editado');
        exit;
    }
    $accion = 'Editar';
    $archivo = 'editar_usuarios.php';
    $usuario = mysqli_fetch_assoc($res_select_usu);
}
echo mysqli_error($cnx);
?>

<section class="container border border-warning my-5">

	<div class="row justify-content-center">
		<h2 class="col-12 text-center display-3 my-5"><?= $accion ?> un usuario</h2>

		<form class="col-8" action="procesos/<?= $archivo ?>" method="POST" enctype="multipart/form-data">
			<?php
            if(isset($usuario['id_usuario'])):

            ?>
                <input type="hidden" name="id" value="<?= $usuario['id_usuario'] ?>">
            <?php
            endif;
            ?>

		  <div class="form-group">
		    <label for="nombre">Nombre *</label>
		    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresar nombre" value="<?= isset($usuario['nombre']) ? $usuario['nombre'] : '' ?>">
		    <small class="form-text text-muted">Obligatorio (*)</small>
		    <?php

            if (isset($errores) && isset($errores->nombre)):
                ?>
                <div class="alert alert-danger fade show mt-2" role="alert">
                    <?= $errores->nombre?>
                </div>
            <?php
            endif;
            ?>
		  </div>
		  <div class="form-group row">
		  	<div class="col-md-6 d-inline-block ">	
			    <label for="apellido">Apellido *</label>
			    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingresar la apellido" value="<?= isset($usuario['apellido']) ? $usuario['apellido'] : '' ?>">
			    <small class="form-text text-muted">(*)</small>
			    <?php

	            if (isset($errores) && isset($errores->apellido)):
	                ?>
	                <div class="alert alert-danger fade show mt-2" role="alert">
	                    <?= $errores->apellido?>
	                </div>
	            <?php
	            endif;
	            ?>
			</div>
			<div class="col-md-6 d-inline-block">
			    <label for="email">Email *</label>
			    <input type="email" class="form-control" id="email" name="email" placeholder="Ingresar el mail" value="<?= isset($usuario['email']) ? $usuario['email'] : '' ?>">
			    <small class="form-text text-muted">(*)</small>
			    <?php

	            if (isset($errores) && isset($errores->email)):
	                ?>
	                <div class="alert alert-danger fade show mt-2" role="alert">
	                    <?= $errores->email?>
	                </div>
	            <?php
	            endif;
	            ?>
			</div>
		  </div>
		  <div class="form-group row">
		  	<div class="col-md-6 form-group">
			    <label for="usuario">Usuario *</label>
			    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingresar usuario de la pelota" value="<?= isset($usuario['usuario']) ? $usuario['usuario'] : '' ?>">
			    <small class="form-text text-muted">(*)</small><?php

	            if (isset($errores) && isset($errores->usuario)):
	                ?>
	                <div class="alert alert-danger fade show mt-2" role="alert">
	                    <?= $errores->usuario?>
	                </div>
	            <?php
	            endif;
	            ?>
		  	</div>
		  	<div class="col-md-6 form-group">
			    <label for="password">Password *</label>
			    <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa el password" value="<?= isset($usuario['password']) ? $usuario['password'] : '' ?>">
			    <small class="form-text text-muted">(*)</small><?php

	            if (isset($errores) && isset($errores->password)):
	                ?>
	                <div class="alert alert-danger fade show mt-2" role="alert">
	                    <?= $errores->password?>
	                </div>
	            <?php
	            endif;
	            ?>
		  	</div>
		  </div>
		  
		  <div class="mb-4">
		  	<button type="submit" class="btn btn-primary">Guardar</button>
		  	<button type="button" class="btn btn-danger" onclick="location.href='index.php?seccion=usuarios'">Cancelar</button>
		  </div>
		</form>

	</div>
</section>