<?php
include_once "app/usuario/model.php";
session_start();

include_once "helpers/vars.php";

if(getvar("accion") === "login") {
    $username = getvar("username");
    $password = getvar("password");
    if($username && $password) {
        $usr = new Usuario();
        if(!$usr->authenticate($username, $password)) {
            $err = "Error al accesar al sistema: usuario o contraseña no válidos";
        }
    }
}

$err_pwd = "";
if(getvar("accion") === "actualizar_pwd" && isset($_SESSION["current_user"])) {
    $pwd_actual = getvar("pwd_actual");
    $pwd_nuevo = getvar("pwd_nuevo");
    $pwd_confirmacion = getvar("pwd_confirmacion");

    $usuario = $_SESSION["current_user"];
    $resultado = $usuario->procesarCambioPassword($pwd_actual, $pwd_nuevo, $pwd_confirmacion);

    if ($resultado["success"]) {
        header("Location: index.php?msg=pwd_updated");
        exit;
    } else {
        $err_pwd = $resultado["err"];
    }
}

$success_msg = "";
if(getvar("msg") === "pwd_updated") {
    $success_msg = "Contraseña actualizada exitosamente. Por favor, ingresa de nuevo con tu nueva contraseña.";
}
?><!DOCTYPE html>
<html lang="es-MX">
<head>
    <?php include 'templates/head.php'; ?>
</head>
<body class="d-flex flex-column vh-100">
    <?php include 'templates/header.php'; ?>

    <main class="container flex-grow-1 d-flex flex-column">

        <h1 class="mb-4"><span class="colores-gay big-text">Bienvenido <?php echo $_SESSION["current_user"] ?? "Lobo"; ?>!!</span></h1>

        <?php if(!(isset($_SESSION["current_user"]) && $_SESSION["current_user"])): ?>

            <div class="flex-grow-1 d-flex justify-content-center align-items-center">
                <form class="p-4 rounded shadow custom-border" id="main-form" method="post" autocomplete="off">
                    <h2 class="text-center mb-4">Acceso</h2>
                    <?php if(isset($err) && $err):?>
                        <div class="alert alert-danger" role="alert"><?php echo $err; ?></div>
                    <?php endif; ?>
                    <?php if($success_msg):?>
                        <div class="alert alert-success alert-dismissible fade show" style="font-size: 0.95rem;" role="alert">
                            <i class="fa-solid fa-circle-check me-1"></i> <?php echo $success_msg; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <?php include "app/usuario/form_login.php"; ?>
                    <button type="submit" class="btn btn-primary w-100">Entrar</button>
                    <p class="text-center mt-3 mb-0">
                        ¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a>.
                    </p>
                </form>
            </div>

        <?php else: ?>

            <div class="mt-4 d-flex flex-column justify-content-center align-items-center flex-grow-1">
                <div class="card shadow-sm" style="max-width: 400px; width: 100%;">
                    <div class="card-body text-center p-4">
                        <h3 class="card-title mb-4">Mi Pase de Acceso</h3>
                        <?php
                            $mat = @$_SESSION["current_user"]->matricula;
                            $uid = @$_SESSION["current_user"]->id;
                            $fallback = @$_SESSION["current_user"]->getQrData();
                        ?>
                        <div id="qrcode" class="d-flex justify-content-center mb-3" data-matricula="<?php echo $mat; ?>" data-id="<?php echo $uid; ?>" data-fallback="<?php echo $fallback; ?>"></div>
                        <p id="qr-label" class="text-muted font-monospace mb-0"></p>

                        <hr class="mt-4">
                        <button type="button" class="btn btn-outline-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#modalActualizarPwd">
                            Actualizar Contraseña
                        </button>
                    </div>
                </div>
            </div>
            <?php include 'app/usuario/form_actualizar_password.php'; ?>

            <script src="assets/js/qr_generator.js"></script>
        <?php endif; ?>

    </main>

    <?php include 'templates/footer.php'; ?>
</body>
</html>
