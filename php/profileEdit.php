<?php
    include 'components.php';
    $user = getProfileData();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php headContent("Editar Perfil"); ?>

</head>

<body>
    <header>
        <?php navbar(); ?>
    </header>

    <main>
        <div class="form-wrapper">
            <div class="form-card">
                <h2>Editar Perfil</h2>

                <form action="process.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="accion" value="profileEdit" >
                    

                    <div class="form-group profile-group">
                        <div class="profile-pic-wrapper">
                            <img id="preview-img" src="<?php
                                if (!empty($user['imagenUsuario'])) {
                                    echo 'data:image/jpeg;base64,' . base64_encode($user['imagenUsuario']);
                                } else {
                                    echo '/walletDigital/src/img/profileImage.png';
                                } ?>" alt="Foto de perfil" class="profile-pic">
                        </div>
                        <label for="image">Foto de perfil</label>
                        <input type="file" accept=".jpg, .jpeg, .png" name="image" id="image" class="hidden-input">
                        <small id="error-formato" style="color: red; display: none; font-weight: 500;">
                            Solo imágenes JPG o PNG.
                        </small>

                    </div>


                    <div class="form-group">
                        <label>Nombre Completo</label>
                        <input type="text" name="name" value="<?= htmlspecialchars($user['nombreCompleto']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Usuario</label>
                        <input type="text" name="username" value="<?= htmlspecialchars($user['usuario']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Correo</label>
                        <input type="email" name="email" value="<?= htmlspecialchars($user['correo']) ?>" required>
                    </div>

                    <button class="btn_general" type="submit">Guardar</button>
                    <button class="btn-rojo" onclick="window.history.go(-1)">Regresar</button>

                </form>
            </div>
        </div>
    </main>

    <?php footer(); ?>

    <script src="/walletDigital/src/js/signup.js"></script>
</body>
</html>