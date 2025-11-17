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
</head>

<body>
    <header>
        <?php navbar(); ?>
    </header>

    <main>
        <h2 class="titulo">Mis tarjetas</h2>

        <div class="cards-container">
            <?php foreach ($tarjetas as $t): ?>
                <div class="card <?php echo strtolower($t['banco']); ?>">
                    <h3><?php echo $t['banco']; ?></h3>
                    <p><strong>Número:</strong> **** **** **** <?php echo substr($t['numeroTarjeta'], -4); ?></p>
                    <p><strong>Saldo:</strong> $<?php echo number_format($t['saldo'], 2); ?></p>
                    <p class="fecha">Registrada: <?php echo date("d-m-Y", strtotime($t['fechaRegistro'])); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php footer(); ?>
</body>
</html>