<?php
session_start();
require_once "conection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';

    // Iniciar Sesion 
    if ($accion === 'login') {
        $userInput = trim($_POST['usernameOrEmail'] ?? '');
        $password  = trim($_POST['password'] ?? '');

        if (!empty($userInput) && !empty($password)) {
            try {
                
                $query = "SELECT * FROM usuario WHERE usuario = :input OR correo = :input LIMIT 1";

                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':input', $userInput, PDO::PARAM_STR);
                $stmt->execute();

                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user && password_verify($password, $user['password'])) {

                    $_SESSION['id'] = $user['idUsuario'];
                    $_SESSION['nombre_completo'] = $user['nombreCompleto'];
                    $_SESSION['usuario'] = $user['usuario'];

                    header('Location: /walletDigital/myCards.php');
                    exit;
                } else {
                    echo 'Credenciales inválidas.';
                }

            } catch (PDOException $e) {
                echo 'Error en la conexión: ' . $e->getMessage();
            }
        } else {
            echo 'Por favor, complete todos los campos.';
        }
    }

    // Logout
    if ($accion === 'logout') {
        session_destroy();
        header("Location: /walletDigital/index.php");
        exit;
    }


    // Registrar usuario
    if ($accion === 'signup') {

        $name = trim($_POST['name'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($name) || empty($username) || empty($email) || empty($password)) {
            echo "Por favor, complete todos los campos.";
            exit;
        }

        $imageData = null;

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imgInfo = getimagesize($_FILES['image']['tmp_name']);
            if ($imgInfo === false) {
                echo "El archivo no es una imagen válida.";
                exit;
            }
            $imageData = file_get_contents($_FILES['image']['tmp_name']);
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuario (nombreCompleto, usuario, correo, password, imagenUsuario) VALUES (:name, :username, :email, :password, :image)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':image', $imageData, PDO::PARAM_LOB);
        $stmt->execute();

        header("Location: login.php");
        exit;
    }

    // Agregar Tarjeta
    if($accion === 'addCard') {
        $cardNumber = trim($_POST['cardNumber'] ?? '');
        $bank = trim($_POST['bank'] ?? '');
        $fechaRegistro = trim($_POST['fechaRegistro'] ?? '');
        $saldo = trim($_POST['saldo'] ?? '');

        if (empty($cardNumber) || empty($bank) || empty($fechaRegistro) || empty($saldo)) {
            echo "Por favor, complete todos los campos.";
            exit;
        }

        $userId = $_SESSION['id'];

        $sql = "INSERT INTO tarjetas (numeroTarjeta, banco, fechaRegistro, saldo, idUsuario) VALUES (:cardNumber, :bank, :fechaRegistro, :saldo, :userId)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':cardNumber', $cardNumber);
        $stmt->bindParam(':bank', $bank);
        $stmt->bindParam(':fechaRegistro', $fechaRegistro);
        $stmt->bindParam(':saldo', $saldo);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();

        header("Location: /walletDigital/myCards.php");
        exit;
    }

    // Editar Perfil
    if ($accion === 'profileEdit') {
        $name = trim($_POST['name'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');

        if (empty($name) || empty($username) || empty($email)) {
            echo "Por favor, complete todos los campos.";
            exit;
        }

        $imageData = null;

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imgInfo = getimagesize($_FILES['image']['tmp_name']);
            if ($imgInfo === false) {
                echo "El archivo no es una imagen válida.";
                exit;
            }
            $imageData = file_get_contents($_FILES['image']['tmp_name']);
        }

        $userId = $_SESSION['id'];

        if ($imageData !== null) {
            $sql = "UPDATE usuario SET nombreCompleto = :name, usuario = :username, correo = :email, imagenUsuario = :image WHERE idUsuario = :userId";
        } else {
            $sql = "UPDATE usuario SET nombreCompleto = :name, usuario = :username, correo = :email WHERE idUsuario = :userId";
        }

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        if ($imageData !== null) {
            $stmt->bindParam(':image', $imageData, PDO::PARAM_LOB);
        }
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();

        header("Location: /walletDigital/php/profileView.php");
        exit;
    }

    // Editar Tarjeta
    if ($accion === 'editCard') {
        $idTarjeta = $_POST['idTarjeta'];
    $saldo = $_POST['saldo'];

    $sql = $pdo->prepare("UPDATE tarjetas SET saldo = :saldo WHERE idTarjeta = :id");
    $sql->execute([":saldo" => $saldo, ":id" => $idTarjeta]);

    header("Location: /walletDigital/myCards.php");
    exit;
    }

    // Eliminar Tarjeta
    if ($accion === 'DeleteCard') {
         $idTarjeta = $_POST['idTarjeta'];

        $sql = $pdo->prepare("DELETE FROM tarjetas WHERE idTarjeta = :id");
        $sql->execute([":id" => $idTarjeta]);

        header("Location: /walletDigital/myCards.php");
        exit;
    }

}
?>
