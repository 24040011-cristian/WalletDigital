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
    <header>
        <h1>Bienvenido a Digital Wallet</h1>
    </header>

    <main>
    <section>
    <div>
      <div>
        <a class="btn_general" href="php/login.php">Iniciar Sesión</a>
        <a class="btn_general" href="php/signup.php">Crear Cuenta</a>
      </div>
    </div>
  </section>
  </main>

    <?php footer(); ?>
</body>
</html>