<?php
require_once("../../setup/configuracion.php");
require_once("../../setup/funciones.php");
$id = intval($_POST['id']);
$select_prod = "SELECT * 
    FROM usuarios
    WHERE id_usuario=$id";
$res_select_prod = mysqli_query($cnx, $select_prod);
if (!$res_select_prod->num_rows) {
    header('Location: ../index.php?secciones=alta_usuario&status=errorenproceso&accion=editado');
    exit;
}

$errores = [];
if (empty($_POST['nombre'])){
    $errores['nombre'] = 'El nombre no puede estar vacío';
}
elseif (strlen($_POST['nombre']) > 80){
    $errores['nombre'] = 'El nombre puede tener hasta 80 caracteres';
    }

if (empty($_POST['apellido'])){
        $errores['apellido'] = 'El apellido no puede estar vacío';
} elseif (strlen($_POST['apellido']) > 80){
        $errores['apellido'] = 'El apellido puede tener hasta 80 caracteres';
}

if (empty($_POST['usuario'])){
    $errores['usuario'] = 'El usuario no puede estar vacío';
    } elseif (strlen($_POST['usuario']) > 60){ 
        $errores['usuario'] = 'El nombre puede tener hasta 60 caracteres';
}

if (empty($_POST['email'])){
    $errores['email'] = 'El email no puede estar vacío';
    } elseif (strlen($_POST['email']) > 100){
        $errores['email'] = 'El email puede tener hasta 100 caracteres';
    }

if (empty($_POST['password']))
    $errores['password'] = 'La contraseña no puede estar vacía';
elseif (strlen($_POST['password']) < 4)
    $errores['password'] = 'La contraseña debe de tener al menos 4 caracteres';


if (count($errores)) {
    $json_errores = json_encode($errores);

    header("Location: ../index.php?seccion=alta_usuario&status=errorenproceso&campos=$json_errores");
    exit;
}
$nombre_escape = mysqli_real_escape_string($cnx, $_POST['nombre']);
$nombre = $nombre_escape;

$apellido_escape = mysqli_real_escape_string($cnx, $_POST['apellido']);
$apellido = $apellido_escape;

$usuario_escape = mysqli_real_escape_string($cnx, $_POST['usuario']);
$usuario = $usuario_escape;

$email_escape = mysqli_real_escape_string($cnx, $_POST['email']);
$email = $email_escape;

$password_escape = mysqli_real_escape_string($cnx, $_POST['password']);
$password = password_hash($password_escape, PASSWORD_DEFAULT);


$insert = "UPDATE usuarios SET
nombre='$nombre', apellido='$apellido', usuario='$usuario', email='$email', password='$password' WHERE id_usuario = $id";
$res_insert = mysqli_query($cnx, $insert);

header("Location: ../index.php?seccion=usuarios&status=ok&accion=editado");
