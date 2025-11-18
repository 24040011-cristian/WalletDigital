<?php
    include 'php/components.php';
    include 'php/getCards.php';
    userLogged();

    $tarjetas = getCards($_SESSION['id']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php headContent("Mis Tarjetas"); ?>
    <link rel="stylesheet" href="/walletDigital/src/css/cards.css">
</head>

<body>
    <header>
        <?php navbar(); ?>
    </header>

    <main>
        <h2 class="titulo">Mis tarjetas</h2>

        <div class="cards-container">
            <?php foreach ($tarjetas as $t): ?>
                <div class="card <?php echo strtolower($t['banco']); ?> card-item" data-id="<?= $t['idTarjeta'] ?>" data-saldo="<?= $t['saldo'] ?>">
                    <h3><?php echo $t['banco']; ?></h3>
                    <p><strong>Número:</strong> **** **** **** <?php echo substr($t['numeroTarjeta'], -4); ?></p>
                    <p><strong>Saldo:</strong> $<?php echo number_format($t['saldo'], 2); ?></p>
                    <p class="fecha">Registrada: <?php echo date("d-m-Y", strtotime($t['fechaRegistro'])); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <div id="modalCard" class="modal hidden">
    <div class="modal-content">

        <h3>Editar Tarjeta</h3>

        <form id="formEditCard" method="POST" action="/walletDigital/php/process.php">
            <input type="hidden" name="accion" value="editCard">
            <input type="hidden" name="idTarjeta" id="idTarjeta">

            <label>Saldo:</label>
            <input type="number" step="0.01" name="saldo" id="saldo" required>

            <div class="modal-buttons">
                <button type="submit" class="btn_general">Guardar cambios</button>

                <button type="button" id="btnDelete" class="btn-rojo">Eliminar tarjeta</button>

                <button type="button" class="btn-rojo" id="btnCloseModal">
                    Cerrar
                </button>
            </div>
        </form>
    </div>
</div>

    <script src="/walletDigital/src/js/formCard.js"></script>
    <?php footer(); ?>
</body>
</html>