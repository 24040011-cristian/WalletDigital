<?php
    // Cabecera HTML
    function headContent($title) {
        echo '<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="/WalletDigital/src/img/wallet.png" type="image/x-icon">
        <title>'.$title.' | Wallet Digital</title>
        
        <link rel="stylesheet" href="/walletDigital/src/css/style.css">
        <link rel="stylesheet" href="/walletDigital/src/css/form.css">
        <link rel="stylesheet" href="/walletDigital/src/css/navbar.css">';
    }

    // Footer
    function footer() {
        echo '
          <footer>
    <p>&copy; 2025 Wallet Digital | Todos los derechos reservados</p>
  </footer>
        ';
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    include __DIR__ . '/alerts.php';
    }

    // Verificar si el usuario ha iniciado sesión
    function userLogged() {
        require __DIR__ . '/conection.php';
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['id'])) {
            header('Location: /walletDigital/php/login.php');
            exit;
        }

        $nombre = $_SESSION['nombre_completo'] ?? 'Usuario';
        $username = $_SESSION['usuario'] ?? '';

        $sql = $pdo->prepare("SELECT imagenUsuario FROM usuario WHERE usuario = :usuario LIMIT 1");
        $sql->bindParam(':usuario', $username);
        $sql->execute();
        $foto = $sql->fetch(PDO::FETCH_ASSOC);

        return [
            'nombre' => $nombre,
            'foto' => $foto['imagenUsuario'] ?? null
        ];
    }

    // Barra de navegacion
    function navBar() {
        $user = userLogged();
        $nombre = htmlspecialchars($user['nombre']);
        $foto = $user['foto'];

        if ($foto) {
            $fotoSrc = "data:image/jpeg;base64," . base64_encode($foto);
        } else {
            $fotoSrc = "/walletDigital/src/img/profileImage.png";
        }

        echo '
        <div class="navbar-bank">
            <div class="user-section">
                <img class="user-photo" src="' . $fotoSrc . '" alt="Foto perfil">
                <span class="user-name">' . $nombre . '</span>
            </div>

            <div class="action-section">
                <a href="/walletDigital/myCards.php" class="btn_general">Mis Tarjetas</a>
                <a href="/walletDigital/php/addCards.php" class="btn_general">Agregar Tarjetas</a>
                <a href="/walletDigital/php/profileView.php" class="btn_general">Perfil</a>

                <form action="/walletDigital/php/process.php" method="POST" class="logout-form">
                    <input type="hidden" name="accion" value="logout">
                    <button type="submit" class="btn-rojo">Cerrar Sesión</button>
                </form>
            </div>
        </div>';
    }

    function getProfileData()
    {
        require __DIR__ . '/conection.php';
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['id'])) {
            header('Location: /walletDigital/php/login.php');
            exit;
        }

        $userId = $_SESSION['id'];

        $sql = $pdo->prepare("SELECT nombreCompleto, usuario, correo, imagenUsuario FROM usuario WHERE idUsuario = :id LIMIT 1");
        $sql->bindParam(':id', $userId);
        $sql->execute();

        return $sql->fetch(PDO::FETCH_ASSOC);
    }
?>