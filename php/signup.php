<?php
    include 'components.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php headContent("Registrarse"); ?>
</head>

<body>
    <header>
        
    </header>

    <main>
        <div class="form-wrapper">
            <div class="form-card">
                <h2>Registrarse</h2>
                <p>Nuevo usuario</p>

                <form action="process.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="accion" value="signup" >
                    


                    <div class="form-group profile-group">
                        <div class="profile-pic-wrapper">
                            <img id="preview-img" src="/walletDigital/src/img/profileImage.png" alt="Foto" class="profile-pic">
                        </div>
                        <label for="image">Foto de perfil</label>
                        <input type="file" accept=".jpg, .jpeg, .png" name="image" id="image" class="hidden-input">
                        <small id="error-formato" style="color: red; display: none; font-weight: 500;">
                            Solo imágenes JPG o PNG.
                        </small>

                    </div>


                    <div class="form-group">
                        <label>Nombre Completo</label>
                        <input type="text" name="name" required>
                    </div>

                    <div class="form-group">
                        <label>Usuario</label>
                        <input type="text" name="username" required>
                    </div>

                    <div class="form-group">
                        <label>Correo</label>
                        <input type="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="password" name="password" required>
                    </div>

                    <button class="btn_general" type="submit">Registrar</button>
                    <button class="btn-rojo" onclick="window.history.go(-1)">Regresar</button>

                </form>
            </div>
        </div>
    </main>

    <?php footer(); ?>

    <script src="/walletDigital/src/js/signup.js"></script>
</body>
</html>