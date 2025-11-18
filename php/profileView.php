<?php
include 'components.php';
$user = getProfileData();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php headContent("Perfil"); ?>
    <link rel="stylesheet" href="/walletDigital/src/css/profile.css">
</head>

<body>
<header>
    <?php navbar(); ?>
</header>

<main>
    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-img-wrapper">
                <?php if (!empty($user['imagenUsuario'])): ?>
                    <img src="data:image/jpeg;base64,<?= base64_encode($user['imagenUsuario']) ?>" 
                         alt="Foto de perfil" class="profile-img">
                <?php else: ?>
                    <img src="/walletDigital/src/img/profileImage.png" class="profile-img">
                <?php endif; ?>
            </div>

            <div class="info-box">
                <p class="profile-name"><?= htmlspecialchars($user['nombreCompleto']) ?></p>
                <p><strong>Usuario:</strong> @<?= htmlspecialchars($user['usuario']) ?></p>
                <p><strong>Correo:</strong> <?= htmlspecialchars($user['correo']) ?></p>
                
            </div>

            <a href="/walletDigital/php/profileEdit.php" class="btn_general">Editar perfil</a>

        </div>

    </div>
</main>

<?php footer(); ?>

</body>
</html>

