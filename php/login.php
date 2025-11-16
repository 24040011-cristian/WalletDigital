<?php
    include 'components.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php headContent("Incio de Sesión"); ?>
</head>

<body>
    <header>
        
    </header>

    <main>
        <div class="form-wrapper">
            <div class="form-card">
                <h2>Iniciar Sesión</h2>
                <p>Accede a tu cuenta para continuar</p>

                <form action="process.php" method="POST">
                    <input type="hidden" name="accion" value="login">

                    <div class="form-group">
                        <label>Usuario o Correo</label>
                        <input type="text" name="usernameOrEmail" required>
                    </div>

                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="password" name="password" required>
                    </div>

                    <button class="btn_general" type="submit">Iniciar Sesión</button>
                    <button class="btn-rojo" onclick="window.history.go(-1)">Regresar</button>


                    <p class="form-extra-text">
                        ¿No tienes cuenta? <a href="signup.php">Regístrate aquí</a>
                    </p>
                </form>
            </div>
        </div>
    </main>

    <?php footer(); ?>
</body>
</html>