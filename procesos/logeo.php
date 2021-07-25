<?php
require_once('../setup/configuracion.php');
require_once('../setup/funciones.php');

if((empty($_POST['user'])) || (empty($_POST['pass']))) {
    header("Location: ../index.php?seccion=login&status=vacio");
    exit;    
}


$usr_escape = mysqli_real_escape_string($cnx, $_POST['user']);
$select_usr = "SELECT * FROM usuarios WHERE usuario = '$usr_escape'";
$res_usr = mysqli_query($cnx, $select_usr);
$user = mysqli_fetch_assoc($res_usr);

if ((!$res_usr->num_rows) || !password_verify($_POST['pass'], $user['password'])) {
    header("Location: ../index.php?seccion=login&status=error");
    exit;
}
unset($user['password']);

$_SESSION['usuario'] = $user;

if (!empty($_POST['recordarme']) && $_POST['recordarme'] == 'true') {
setcookie('usuarioactivo', json_encode($user), strtotime('+30 days'), '/');
}

header("Location: ../index.php?seccion=home");
