<!DOCTYPE html>
<html lang="es-MX">
<head>
    <?php include 'templates/head.php'; ?>
</head>
<body>
    <?php include 'templates/header.php'; ?>

    <main class="container">
        <h1>Bienvenido al sitio de TICs 2026</h1>
        Sitio
    </main>
    <img src="generador_qr.php?m=<?php echo $estudiante['matricula']; ?>" alt="QR">
    <?php include 'templates/footer.php'; ?>
</body>
</html>
