<?php
include 'php/components.php';

session_start();

if (isset($_SESSION['id'])) {
    header('Location: myCards.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php headContent("Bienvenido"); ?>

</head>

<body>
    <header class="index-header">
        <h1>Wallet<span class="cian_color">Digital</span>.</h1>
    </header>

    <main class="index-main">
        <section class="intro-container">
            <div class="intro-text">
                <h2>Tus finanzas, <br><span>simplificadas</span>.</h2>
                <p>Envía, recibe y gestiona tu dinero con la seguridad que mereces. Únete a la nueva era de la banca digital sin complicaciones.</p>
                
                <div class="indexdiv-buttons">
                    <a class="btn_general" href="php/signup.php">Crear Cuenta</a>
                    <a class="btn_general" href="php/login.php">Iniciar Sesión</a>
                </div>
            </div>
        </section>
    </main>

    <?php footer(); ?>
</body>
</html>