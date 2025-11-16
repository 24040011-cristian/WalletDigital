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



}