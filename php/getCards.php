 <?php
    require_once "conection.php";
    
    function getCards($idUsuario) {
        global $pdo;
        $query = $pdo->prepare("SELECT * FROM tarjetas WHERE idUsuario = :id");
        $query->execute(['id' => $idUsuario]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

?>